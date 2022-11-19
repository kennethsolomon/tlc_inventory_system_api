<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemPostRequest;
use App\Http\Requests\ItemStatusPostRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\ItemList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemResource::collection(Item::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateItem(ItemPostRequest $request)
    {
        try {

            DB::beginTransaction();

            if ($request->purchaser == 'Regional Office') {
                $fields = $request->validated();

                $item = Item::updateOrCreate(
                    ['id' => $request->id],
                    $fields + ['quantity' => 1]
                );
            } else {
                for ($i = 1; $i <= $request->quantity; $i++) {
                    Log::debug($request->quantity);
                    $fields = $request->validated();

                    $item = Item::updateOrCreate(
                        ['id' => $request->id],
                        $fields
                    );

                    // $item_list = ItemList::wherePropertyName($request->property_name);

                    // if ($item_list->exists()) {
                    //     $item_list_data = $item_list->first();
                    //     $item_list_data->property_name = $request->property_name;
                    //     $item_list_data->description = $request->description;
                    //     $item_list_data->cost = $request->cost;
                    //     $item_list_data->type = $request->type;
                    //     $item_list_data->purchaser = $request->purchaser;
                    //     $item_list_data->item_category_id = $request->item_category_id;
                    //     $item_list_data->quantity += 1;
                    //     $item_list_data->save();
                    // } else {
                    //     $item_list_data = new ItemList;
                    //     $item_list_data->property_name = $request->property_name;
                    //     $item_list_data->description = $request->description;
                    //     $item_list_data->cost = $request->cost;
                    //     $item_list_data->type = $request->type;
                    //     $item_list_data->purchaser = $request->purchaser;
                    //     $item_list_data->item_category_id = $request->item_category_id;
                    //     $item_list_data->quantity = $request->quantity;
                    //     $item_list_data->save();
                    // }
                }
            }

























            DB::commit();
            return (new ItemResource($item))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return (new ItemResource($item))->response()->setStatusCode(202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        try {
            DB::beginTransaction();
            $item->delete();

            DB::commit();

            return response($item, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

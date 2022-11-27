<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemPostRequest;
use App\Http\Requests\ItemStatusPostRequest;
use App\Http\Requests\TransactionPostRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\ItemList;
use App\Models\Log;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
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


    public function itemTrash()
    {
        return ItemResource::collection(Item::onlyTrashed()->get())->response()->setStatusCode(200);
    }

    public function restore($id)
    {

        $log = ['user' => auth()->user()->email, 'action' => 'Create/Update', 'description' => 'Property  with ID ' . $id . ' has been restored.'];
        Log::create($log);
        return Item::withTrashed()->find($id)->restore();
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

                $log = ['user' => auth()->user()->email, 'action' => 'Create/Update', 'description' => 'Item  with ID ' . $item->id . ' has been created/updated.'];
                Log::create($log);
            } else {
                for ($i = 1; $i <= $request->quantity; $i++) {
                    $fields = $request->validated();

                    $item = Item::updateOrCreate(
                        ['id' => $request->id],
                        $fields
                    );

                    $log = ['user' => auth()->user()->email, 'action' => 'Create/Update', 'description' => 'Item  with ID ' . $item->id . ' has been created/updated.'];
                    Log::create($log);
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

            $log = ['user' => auth()->user()->email, 'action' => 'Delete', 'description' => 'Item with ' . $item->id . ' has been deleted.'];
            Log::create($log);


            return response($item, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

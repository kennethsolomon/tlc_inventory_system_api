<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemPostRequest;
use App\Http\Requests\ItemStatusPostRequest;
use App\Http\Requests\TransactionPostRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\ItemList;
use App\Models\Transaction;
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

            return response($item, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStatusPostRequest;
use App\Http\Resources\ItemStatusResource;
use App\Models\ItemStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ItemStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemStatusResource::collection(ItemStatus::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateItemStatus(ItemStatusPostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $item_status = ItemStatus::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new ItemStatusResource($item_status))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemStatus  $item_status
     * @return \Illuminate\Http\Response
     */
    public function show(ItemStatus $item_status)
    {
        return (new ItemStatusResource($item_status))->response()->setStatusCode(202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemStatus  $item_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemStatus $item_status)
    {
        try {
            DB::beginTransaction();
            $item_status->delete();

            DB::commit();

            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

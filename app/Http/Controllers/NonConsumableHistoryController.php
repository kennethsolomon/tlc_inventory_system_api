<?php

namespace App\Http\Controllers;

use App\Http\Requests\NonConsumableHistoryPostRequest;
use App\Http\Resources\NonConsumableHistoryResource;
use App\Models\NonConsumableHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class NonConsumableHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NonConsumableHistoryResource::collection(NonConsumableHistory::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateItem(NonConsumableHistoryPostRequest $request)
    {
        try {

            DB::beginTransaction();

            $fields = $request->validated();

            $consumable = NonConsumableHistory::updateOrCreate(
                ['id' => $request->id],
                $fields
            );


            DB::commit();
            return (new NonConsumableHistoryResource($consumable))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsumableHistoryPostRequest;
use App\Http\Resources\ConsumableHistoryResource;
use App\Models\ConsumableHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ConsumableHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConsumableHistoryResource::collection(ConsumableHistory::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateItem(ConsumableHistoryPostRequest $request)
    {
        try {

            DB::beginTransaction();

            $fields = $request->validated();

            $consumable = ConsumableHistory::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new ConsumableHistoryResource($consumable))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

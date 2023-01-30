<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsumablePostRequest;
use App\Http\Resources\ConsumableResource;
use App\Models\Consumable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ConsumableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConsumableResource::collection(Consumable::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateItem(ConsumablePostRequest $request)
    {
        try {

            DB::beginTransaction();

            $fields = $request->validated();

            $consumable = Consumable::updateOrCreate(
                ['id' => $request->id],
                $fields
            );


            DB::commit();
            return (new ConsumableResource($consumable))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

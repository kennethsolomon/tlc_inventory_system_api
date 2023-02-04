<?php

namespace App\Http\Controllers;

use App\Http\Requests\NonConsumablePostRequest;
use App\Http\Resources\NonConsumableResource;
use App\Models\NonConsumable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class NonConsumableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NonConsumableResource::collection(NonConsumable::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateItem(NonConsumablePostRequest $request)
    {
        try {

            DB::beginTransaction();

            $fields = $request->validated();

            $consumable = NonConsumable::updateOrCreate(
                ['id' => $request->id],
                $fields
            );


            DB::commit();
            return (new NonConsumableResource($consumable))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

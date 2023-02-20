<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Requests\PropertyPostRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Log;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PropertyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PropertyResource::collection(Property::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateProperty(PropertyPostRequest $request)
    {
        try {

            DB::beginTransaction();
            $fields = $request->validated();

            $property = Property::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new PropertyResource($property))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        try {
            DB::beginTransaction();
            $property->delete();
            DB::commit();
            return response($property, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

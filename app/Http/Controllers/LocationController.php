<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationPostRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends Controller
{
    public function index()
    {
        return LocationResource::collection(Location::all())->response()->setStatusCode(200);
    }

    public function updateOrCreateLocation(LocationPostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $location = Location::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new LocationResource($location))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function destroy(Location $location)
    {
        try {
            DB::beginTransaction();
            $location->delete();

            DB::commit();

            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\DescriptionPostRequest;
use App\Http\Resources\DescriptionResource;
use App\Models\Description;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DescriptionController extends Controller
{
    public function index()
    {
        return DescriptionResource::collection(Description::all())->response()->setStatusCode(200);
    }

    public function updateOrCreateDescription(DescriptionPostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $description = Description::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new DescriptionResource($description))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function destroy(Description $description)
    {
        try {
            DB::beginTransaction();
            $description->delete();

            DB::commit();

            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

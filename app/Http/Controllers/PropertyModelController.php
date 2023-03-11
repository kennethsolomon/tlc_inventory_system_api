<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyModelPostRequest;
use App\Http\Resources\PropertyModelResource;
use App\Models\PropertyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PropertyModelController extends Controller
{
    public function index()
    {
        return PropertyModelResource::collection(PropertyModel::all())->response()->setStatusCode(200);
    }

    public function updateOrCreateModel(PropertyModelPostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $model = PropertyModel::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new PropertyModelResource($model))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function destroy(PropertyModel $model)
    {
        try {
            DB::beginTransaction();
            $model->delete();

            DB::commit();

            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandPostRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class BrandController extends Controller
{
    public function index()
    {
        return BrandResource::collection(Brand::all())->response()->setStatusCode(200);
    }

    public function updateOrCreateBrand(BrandPostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $brand = Brand::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new BrandResource($brand))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function destroy(Brand $brand)
    {
        try {
            DB::beginTransaction();
            $brand->delete();

            DB::commit();

            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

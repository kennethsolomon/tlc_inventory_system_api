<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryPostRequest;
use App\Http\Requests\ItemCategoryPostRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ItemCategoryResource;
use App\Models\Category;
use App\Models\ItemCategory;
use App\Models\Log;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ItemCategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all())->response()->setStatusCode(200);
    }

    public function updateOrCreateCategory(CategoryPostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $item_category = Category::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new CategoryResource($item_category))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();
            $category->delete();

            DB::commit();

            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

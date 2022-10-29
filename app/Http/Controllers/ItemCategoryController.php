<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCategoryPostRequest;
use App\Http\Resources\ItemCategoryResource;
use App\Models\ItemCategory;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ItemCategoryResource::collection(ItemCategory::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateItemCategory(ItemCategoryPostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $item_category = ItemCategory::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new ItemCategoryResource($item_category))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemCategory  $item_category
     * @return \Illuminate\Http\Response
     */
    public function show(ItemCategory $item_category)
    {
        return (new ItemCategoryResource($item_category))->response()->setStatusCode(202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemCategory  $item_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCategory $item_category)
    {
        try {
            DB::beginTransaction();
            $item_category->delete();

            DB::commit();

            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}

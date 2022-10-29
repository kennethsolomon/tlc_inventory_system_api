<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get("register", [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post("logout", [\App\Http\Controllers\AuthController::class, 'logout']);
});

Route::post("login", [\App\Http\Controllers\AuthController::class, 'login']);

// Employee
Route::get("employees", [\App\Http\Controllers\EmployeeController::class, 'index']);
Route::get("employee/{employee}", [\App\Http\Controllers\EmployeeController::class, 'show']);
Route::post("update_or_create_employee", [\App\Http\Controllers\EmployeeController::class, 'updateOrCreateEmployee']);
Route::delete("delete_employee/{employee}", [\App\Http\Controllers\EmployeeController::class, 'destroy']);

// Item Category
Route::get("item_categories", [\App\Http\Controllers\ItemCategoryController::class, 'index']);
Route::get("item_category/{item_category}", [\App\Http\Controllers\ItemCategoryController::class, 'show']);
Route::post("update_or_create_item_category", [\App\Http\Controllers\ItemCategoryController::class, 'updateOrCreateItemCategory']);
Route::delete("delete_item_category/{item_category}", [\App\Http\Controllers\ItemCategoryController::class, 'destroy']);

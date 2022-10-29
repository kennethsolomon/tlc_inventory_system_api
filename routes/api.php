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

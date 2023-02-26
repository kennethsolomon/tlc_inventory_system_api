<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:sanctum'], function () {
	Route::get('/user', function (Request $request) {
		return $request->user();
	});
	Route::post("update_account", [\App\Http\Controllers\AuthController::class, 'updateOrCreateUser']);

	Route::get("register", [\App\Http\Controllers\AuthController::class, 'register']);
	Route::post("logout", [\App\Http\Controllers\AuthController::class, 'logout']);
});
// V3
Route::get("properties", [\App\Http\Controllers\Api\V3\PropertyController::class, 'index']);
Route::post("update_or_create_property", [\App\Http\Controllers\Api\V3\PropertyController::class, 'updateOrCreateProperty']);
Route::delete("delete_property/{property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'destroy']);



Route::post("transfer_property/{property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'transferProperty']);
Route::get("property_history/{property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'propertyHistory']);



Route::get("lend_list", [\App\Http\Controllers\Api\V3\PropertyController::class, 'lendList']);
Route::post("lend_property/{property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'lendProperty']);
Route::post("lend_approved/{lend_property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'lendApproved']);
Route::post("lend_cancel/{lend_property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'cancelLend']);
Route::post("return_property/{lend_property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'returnProperty']);



Route::get("maintenance_list", [\App\Http\Controllers\Api\V3\PropertyController::class, 'maintenanceList']);
Route::post("disposed/{maintenance}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'disposed']);
Route::post("fixed/{maintenance}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'fixed']);
Route::post("on_maintenance/{property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'onMaintenance']);

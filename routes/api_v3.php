<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

// Route::group(['middleware' => 'auth:sanctum'], function () {
// 	Route::get('/user', function (Request $request) {
// 		return $request->user();
// 	});

// 	Route::get("register", [\App\Http\Controllers\AuthController::class, 'register']);
// 	Route::post("logout", [\App\Http\Controllers\AuthController::class, 'logout']);
// });

Route::group([
	'middleware' => 'api',
	'prefix' => 'auth'

], function ($router) {

	Route::post("login", [\App\Http\Controllers\AuthController::class, 'login']);
	Route::post("logout", [\App\Http\Controllers\AuthController::class, 'logout']);
	Route::post("refresh", [\App\Http\Controllers\AuthController::class, 'refresh']);
	Route::post("me", [\App\Http\Controllers\AuthController::class, 'me']);

	Route::get('/user', function (Request $request) {
		return $request->user();
	});
});

// V3

Route::get("user-borrow-list", [\App\Http\Controllers\AuthController::class, 'userBorrowList']);
Route::post("update-or-create-user", [\App\Http\Controllers\AuthController::class, 'updateOrCreateUser']);

Route::get("properties", [\App\Http\Controllers\Api\V3\PropertyController::class, 'index']);
Route::post("update_or_create_property", [\App\Http\Controllers\Api\V3\PropertyController::class, 'updateOrCreateProperty']);
Route::delete("delete_property/{property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'destroy']);



Route::post("transfer_property", [\App\Http\Controllers\Api\V3\PropertyController::class, 'transferProperty']);
Route::get("property_history/{property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'propertyHistory']);



Route::get("lend_list", [\App\Http\Controllers\Api\V3\PropertyController::class, 'lendList']);
Route::post("lend_property", [\App\Http\Controllers\Api\V3\PropertyController::class, 'lendProperty']);
Route::post("lend_approved/{lend_property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'lendApproved']);
Route::post("lend_cancel/{lend_property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'cancelLend']);
Route::post("return_property/{lend_property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'returnProperty']);



Route::get("maintenance_list", [\App\Http\Controllers\Api\V3\PropertyController::class, 'maintenanceList']);
Route::post("disposed/{maintenance}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'disposed']);
Route::post("fixed/{maintenance}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'fixed']);
Route::post("on_maintenance/{property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'onMaintenance']);
Route::get("user-maintenance", [\App\Http\Controllers\Api\V3\PropertyController::class, 'userMaintenanceList']);


Route::get("categories", [\App\Http\Controllers\ItemCategoryController::class, 'index']);
Route::post("add_category", [\App\Http\Controllers\ItemCategoryController::class, 'updateOrCreateCategory']);
Route::post("delete_category/{category}", [\App\Http\Controllers\ItemCategoryController::class, 'destroy']);

Route::get("brands", [\App\Http\Controllers\BrandController::class, 'index']);
Route::post("add_brand", [\App\Http\Controllers\BrandController::class, 'updateOrCreateBrand']);
Route::post("delete_brand/{brand}", [\App\Http\Controllers\BrandController::class, 'destroy']);

Route::get("models", [\App\Http\Controllers\PropertyModelController::class, 'index']);
Route::post("add_model", [\App\Http\Controllers\PropertyModelController::class, 'updateOrCreateModel']);
Route::post("delete_model/{model}", [\App\Http\Controllers\PropertyModelController::class, 'destroy']);


Route::get("descriptions", [\App\Http\Controllers\DescriptionController::class, 'index']);
Route::post("add_description", [\App\Http\Controllers\DescriptionController::class, 'updateOrCreateDescription']);
Route::post("delete_description/{description}", [\App\Http\Controllers\DescriptionController::class, 'destroy']);


Route::get("users", [\App\Http\Controllers\AuthController::class, 'index']);
Route::post("delete-user/{user}", [\App\Http\Controllers\AuthController::class, 'deleteUser']);

Route::post("add_location", [\App\Http\Controllers\LocationController::class, 'updateOrCreateLocation']);
Route::post("delete_location/{location}", [\App\Http\Controllers\LocationController::class, 'destroy']);


Route::post("approve/{maintenance}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'approve']);

Route::get("locations", [\App\Http\Controllers\LocationController::class, 'index']);

Route::post("change-status/{maintenance}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'changeMaintenanceStatus']);


Route::post("set-damage-property", [\App\Http\Controllers\Api\V3\PropertyController::class, 'setDamageProperty']);

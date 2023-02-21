<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// V3
Route::get("properties", [\App\Http\Controllers\Api\V3\PropertyController::class, 'index']);
Route::post("update_or_create_property", [\App\Http\Controllers\Api\V3\PropertyController::class, 'updateOrCreateProperty']);
Route::delete("delete_property/{property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'destroy']);



Route::post("transfer_property/{property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'transferProperty']);
Route::get("property_history", [\App\Http\Controllers\Api\V3\PropertyController::class, 'propertyHistory']);



Route::get("lend_list", [\App\Http\Controllers\Api\V3\PropertyController::class, 'lendList']);

Route::post("lend_property/{property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'lendProperty']);

Route::post("lend_approved/{lend_property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'lendApproved']);

Route::post("return_property/{lend_property}", [\App\Http\Controllers\Api\V3\PropertyController::class, 'returnProperty']);

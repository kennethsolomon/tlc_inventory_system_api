<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// V3
Route::get("properties", [\App\Http\Controllers\Api\V3\PropertyController::class, 'index']);

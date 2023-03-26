<?php

use App\Services\MaintenanceService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {

    // $MaintenanceService = MaintenanceService::getInstance();

    // $MaintenanceService->handleMaintenance('2023-03-25', 'Biennial');
});

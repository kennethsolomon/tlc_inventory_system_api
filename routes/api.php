<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Route::post("update_account", [\App\Http\Controllers\AuthController::class, 'updateOrCreateUser']);

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
Route::get("items", [\App\Http\Controllers\ItemController::class, 'index']);
Route::get("item/{item}", [\App\Http\Controllers\ItemController::class, 'show']);
Route::post("update_or_create_item", [\App\Http\Controllers\ItemController::class, 'updateOrCreateItem']);
Route::delete("delete_item/{item}", [\App\Http\Controllers\ItemController::class, 'destroy']);

// Item Category
Route::get("item_categories", [\App\Http\Controllers\ItemCategoryController::class, 'index']);
Route::get("item_category/{item_category}", [\App\Http\Controllers\ItemCategoryController::class, 'show']);
Route::post("update_or_create_item_category", [\App\Http\Controllers\ItemCategoryController::class, 'updateOrCreateItemCategory']);
Route::delete("delete_item_category/{item_category}", [\App\Http\Controllers\ItemCategoryController::class, 'destroy']);


// Item Status
Route::get("item_status", [\App\Http\Controllers\ItemStatusController::class, 'index']);
Route::get("item_status/{item_status}", [\App\Http\Controllers\ItemStatusController::class, 'show']);
Route::post("update_or_create_item_status", [\App\Http\Controllers\ItemStatusController::class, 'updateOrCreateItemStatus']);
Route::delete("delete_item_status/{item_status}", [\App\Http\Controllers\ItemStatusController::class, 'destroy']);

// Item List
Route::get("item_list", [\App\Http\Controllers\ItemListController::class, 'index']);
Route::post("item_list_update", [\App\Http\Controllers\ItemListController::class, 'update']);

// Location
Route::get("locations", [\App\Http\Controllers\LocationController::class, 'index']);
Route::get("location/{location}", [\App\Http\Controllers\LocationController::class, 'show']);
Route::post("update_or_create_location", [\App\Http\Controllers\LocationController::class, 'updateOrCreateLocation']);
Route::delete("delete_location/{location}", [\App\Http\Controllers\LocationController::class, 'destroy']);

// Transfer Property
Route::get("transaction_list", [\App\Http\Controllers\TransactionController::class, 'index']);
Route::post("transfer_property", [\App\Http\Controllers\TransactionController::class, 'updateOrCreateTransaction']);
Route::delete("delete_transaction/{transaction}", [\App\Http\Controllers\TransactionController::class, 'destroy']);


// Transfer Property
Route::get("loan_list", [\App\Http\Controllers\LoanController::class, 'index']);
Route::post("loan_property", [\App\Http\Controllers\LoanController::class, 'updateOrCreateLoan']);
Route::delete("delete_loan/{loan}", [\App\Http\Controllers\LoanController::class, 'destroy']);


// Logs
Route::get("logs", [\App\Http\Controllers\LogController::class, 'index']);

// Trash
Route::get("item_trash", [\App\Http\Controllers\ItemController::class, 'itemTrash']);
Route::get("transaction_trash", [\App\Http\Controllers\TransactionController::class, 'transactionTrash']);
Route::get("loan_trash", [\App\Http\Controllers\LoanController::class, 'loanTrash']);

// Restore
Route::get("restore_transaction/{id}", [\App\Http\Controllers\TransactionController::class, 'restore']);
Route::get("restore_loan/{id}", [\App\Http\Controllers\LoanController::class, 'restore']);
Route::get("restore_item/{id}", [\App\Http\Controllers\ItemController::class, 'restore']);



// V2
// {consumable} = consumable id
Route::post("add_stock/{consumable}", [\App\Http\Controllers\ConsumableController::class, 'addStock']);
Route::post("check_out/{consumable}", [\App\Http\Controllers\ConsumableController::class, 'checkOut']);

Route::get("consumables", [\App\Http\Controllers\ConsumableController::class, 'index']);

Route::get("consumables_history", [\App\Http\Controllers\ConsumableHistoryController::class, 'index']);


Route::post("lend_property/{non_consumable}", [\App\Http\Controllers\NonConsumableController::class, 'lendProperty']);
Route::post("return_property/{non_consumable_history}", [\App\Http\Controllers\NonConsumableController::class, 'returnProperty']);

Route::get("maintenance", [\App\Http\Controllers\NonConsumableController::class, 'getMaintenance']);


// use item category natamag gumawa new controller hahah

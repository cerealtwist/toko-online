<?php

use App\Http\Controllers\API\Auth\AdminAuthController;
use App\Http\Controllers\API\Auth\CustomerAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Customers
Route::post('/register', [AuthController::class, 'register']);
Route::post('/customer/login', [CustomerAuthController::class, 'login']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);

// Only for customers
Route::middleware(['auth:sanctum', 'type.customer'])->group(function () {
    // Route::get('/customers/orders', 'API\Customers\OrderController@index');

    // Transaksi
    Route::get('/transaction/show', [TransactionController::class, 'index']);
    Route::get('/transaction/show/{id}', [TransactionController::class, 'show']);
    Route::post('/transaction/pay', [TransactionController::class, 'store']);
});

// Only for admin
Route::middleware(['auth:sanctum', 'type.admin'])->group(function () {
    // Route::get('/admins/orders', 'API\Admins\OrderController@index');

    // ProductController
    Route::get('/admins/products', [ProductController::class, 'index']);
    Route::get('/admins/products/{id}', [ProductController::class, 'show']);
    Route::post('/admins/add/product', [ProductController::class, 'store']);
    Route::put('/admins/products/{id}', [ProductController::class, 'update']);
    Route::delete('/admins/products/{id}', [ProductController::class, 'destroy']);

    // RentController
    Route::get('/rent/delete', [RentController::class, 'destroy']);

    // TransactionController
    Route::get('/transaction/delete', [TransactionController::class, 'destroy']);
});
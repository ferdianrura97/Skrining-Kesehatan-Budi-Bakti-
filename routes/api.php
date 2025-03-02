<?php

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

Route::get('produk/{id}', [\App\Http\Controllers\Api\ProdukController::class, 'produkById']);
Route::get('pelanggan/{id}', [\App\Http\Controllers\Api\PelangganController::class, 'pelangganById']);
Route::get('supplier/{id}', [\App\Http\Controllers\Api\SupplierController::class, 'supplierById']);
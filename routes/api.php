<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\PenjualController;
use App\Http\Controllers\Api\LelangController;
use App\Http\Controllers\Api\TambahStokController;
use App\Http\Controllers\Api\ProdukController;
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

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register_pembeli']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);
Route::post('penjual', [PenjualController::class, 'register_penjual']);
Route::get('penjual/{penjual}', [PenjualController::class, 'get']);
Route::get('penjual', [PenjualController::class, 'get_all']);
Route::delete('penjual/{penjual}', [PenjualController::class, 'delete']);
Route::put('penjual/{penjual}', [PenjualController::class, 'update']);
Route::post('lelang', [LelangController::class, 'tambah_lelang']);
Route::get('lelangg/{lelang}', [LelangController::class, 'tampil_lelang']);
Route::get('lelang', [LelangController::class, 'tampil_semua']);
Route::post('tambah_stok', [TambahStokController::class, 'tambah_stok']);
Route::delete('hapus_stok/{hapus_stok}', [TambahStokController::class, 'hapus_stok']);
Route::post('produk', [ProdukController::class, 'tambah_produk']);
Route::get('produk/{poduk}', [ProdukController::class, 'tampil_produk']);
Route::get('produk', [ProdukController::class, 'tampil_semua']);



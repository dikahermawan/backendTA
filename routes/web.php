<?php

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

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

    Route::get('userdata', [App\Http\Controllers\UserdataController::class, 'index']);

    Route::get('add-userdata', [App\Http\Controllers\UserdataController::class, 'create']);

    Route::post('add-userdata', [App\Http\Controllers\UserdataController::class, 'store']);

    Route::get('edit-userdata/{userdata_id}', [App\Http\Controllers\UserdataController::class, 'edit']);

    Route::put('update-userdata/{userdata_id}', [App\Http\Controllers\UserdataController::class, 'update']);

    Route::get('delete-userdata/{userdata_id}', [App\Http\Controllers\UserdataController::class, 'destroy']);

    Route::get('datapetani', [App\Http\Controllers\PetaniController::class, 'index']);

    Route::get('add-datapetani', [App\Http\Controllers\PetaniController::class, 'create']);

    Route::post('add-datapetani', [App\Http\Controllers\PetaniController::class, 'store']);

    Route::get('edit-datapetani/{datapetani_id}', [App\Http\Controllers\PetaniController::class, 'edit']);

    Route::put('update-datapetani/{datapetani_id}', [App\Http\Controllers\PetaniController::class, 'update']);

    Route::get('delete-datapetani/{datapetani_id}', [App\Http\Controllers\PetaniController::class, 'destroy']);

    Route::get('datapelanggan', [App\Http\Controllers\PelangganController::class, 'index']);

    Route::get('pembayaran', [App\Http\Controllers\PembayaranController::class, 'index']);

    Route::get('pesanan', [App\Http\Controllers\PesananController::class, 'index']);

    Route::get('laporan', [App\Http\Controllers\LaporanController::class, 'index']);

    Route::get('produklelang', [App\Http\Controllers\ProdukLelangController::class, 'index']);

    Route::get('produk', [App\Http\Controllers\ProdukController::class, 'index']);

    Route::get('role', [App\Http\Controllers\RoleController::class, 'index']);

    Route::get('create-role', [App\Http\Controllers\RoleController::class, 'create']);

    Route::post('add-role', [App\Http\Controllers\RoleController::class, 'store']);

    Route::get('edit-role/{role_id}', [App\Http\Controllers\RoleController::class, 'edit']);

    Route::put('update-role/{role_id}', [App\Http\Controllers\RoleController::class, 'update']);

    Route::get('delete-role/{role_id}', [App\Http\Controllers\RoleController::class, 'destroy']);

});


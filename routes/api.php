<?php

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KonsumenController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/callback',[PembelianController::class,'callback']);

// api barang
Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/{id}', [BarangController::class, 'show']);
Route::post('/barang', [BarangController::class, 'store']);
Route::put('/barang/{id}', [BarangController::class, 'update']);
Route::delete('/barang/{id}', [BarangController::class, 'destroy']);

//api kategori
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/{id}', [KategoriController::class, 'show']);
Route::post('/kategori', [KategoriController::class, 'store']);
Route::put('/kategori/{id}', [KategoriController::class, 'update']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

Route::get('/kategoris', [BarangController::class, 'testing']);

// user otp
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/verifyOtp', [UserAuthController::class, "verifyOtp"]);
Route::post('/generateNewOtp', [UserAuthController::class, "generateNewOtp"]);
Route::post('/login', [UserAuthController::class, 'login']);

// konsumen
Route::post('/konsumens', [KonsumenController::class, 'store']);
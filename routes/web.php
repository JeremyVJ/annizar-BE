<?php

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\BiayaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CaraController;
use App\Http\Controllers\Admin\TentangController;
use App\Http\Controllers\KabupatenKotaController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KonsumenController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProductController;
use App\Models\Barang;
use App\Models\Kategori;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('admin/login', function() {
    return view('auth.login');
})->name('admin.login');

Route::get('tentang',[FrontendController::class,'tentangKami'])->name('tentang');
Route::post('search',[FrontendController::class,'search'])->name('search');
Route::get('caraPembelian',[FrontendController::class,'caraPembelian'])->name('caraPembelian');
Route::get('/products/{kategori}', [ProductController::class,'index'])->name('products.index');
Route::get('/products/show/{id}', [ProductController::class,'show'])->name('products.show');
Route::get('/getKabkotaByProvinsi', [KabupatenKotaController::class, 'getKabkotaByProvinsi'])->name('getKabkotaByProvinsi');
Route::get('/kontak', function(){
    return view('kontak');
})->name('kontak');
Route::post('kontak', [FrontendController::class,'feedback'])->name('feedback');

Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->role == 'admin') {
        return redirect()->route('admin.dashboard.index')->with('success', 'Selamat datang di dashboard admin!');
    }
    if (Auth::check() && Auth::user()->role == 'user') {
        return redirect()->route('user.dashboard.index')->with('success', 'Selamat datang di dashboard user!');
    }
    return redirect()->route('admin.login')->with('gagal', 'Anda Harus Login Dulu');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('profile');
    Route::resource('dashboard', AdminDashboardController::class);
    Route::resource('tentang', TentangController::class);
    Route::resource('cara', CaraController::class);
    Route::resource('konsumen', KonsumenController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('biaya', BiayaController::class);
    Route::get('pesanan', [PesananController::class,'showOrderData'])->name('pesanan');
    Route::get('konfirm', [PesananController::class,'konfirm'])->name('konfirm');
    Route::get('showDetail/{id}', [PesananController::class,'showDetail'])->name('show');
    Route::get('konfirmasi/{id}', [PesananController::class,'konfirmasi'])->name('konfirmasi');
    Route::get('kirim/{id}', [PesananController::class,'kirim'])->name('kirim');
    Route::post('updateStatus/{id}', [PesananController::class, 'updateStatus'])->name('updateStatus');
});

// Route::prefix('user')->name('user.')->middleware('isUser')->group(function(){
Route::prefix('user')->name('user.')->group(function(){
    Route::resource('/dashboard', UserDashboardController::class);
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
    Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
    Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
    Route::post('/komentar/{id}', [PembelianController::class, 'komentar'])->name('pembelian.komentar');
    Route::get('/riwayat/pembelian', [PembelianController::class, 'riwayat'])->name('pembelian.riwayat');
    Route::get('/riwayat/delete/{id}', [PembelianController::class, 'deleteRiwayat'])->name('pembelian.deleteRiwayat');
    Route::get('/riwayat/konfirmasi/{id}', [PembelianController::class, 'konfirmasi'])->name('pembelian.konfirmasi');
    Route::get('/keranjang', [PembelianController::class, 'keranjang'])->name('pembelian.keranjang');
    Route::get('/keranjang/delete', [PembelianController::class, 'delete'])->name('pembelian.delete');
    Route::get('/keranjang/checkout', [PembelianController::class, 'checkout'])->name('pembelian.checkout');
    Route::get('/keranjang/transaksi/{id}', [PembelianController::class, 'transaksi'])->name('pembelian.transaksi');
    Route::get('/invoice/{id}', [PembelianController::class, 'invoice'])->name('pembelian.invoice');
    Route::get('/terimakasih', function(){
        return view('terimakasih');
    })->name('terimakasih');
});

require __DIR__.'/auth.php';

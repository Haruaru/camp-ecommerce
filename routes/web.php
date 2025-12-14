<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportingController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PromoController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// User Routes (PUBLIC - tidak perlu login)
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/alat/{id}', [HomeController::class, 'detailAlat'])->name('alat.detail');
Route::get('/paket/{id}', [HomeController::class, 'detailPaket'])->name('paket.detail');
Route::get('/katalog-paket', [HomeController::class, 'katalogPaket'])->name('katalog.paket');
Route::get('/katalog-peralatan', [HomeController::class, 'katalogPeralatan'])->name('katalog.peralatan');
Route::get('/tentang-kami', [HomeController::class, 'tentangKami'])->name('tentang-kami');

// Kebijakan & Proses Routes (PUBLIC)
Route::get('/kebijakan-privasi', [HomeController::class, 'kebijakanPrivasi'])->name('kebijakan.privasi');
Route::get('/syarat-ketentuan', [HomeController::class, 'syaratKetentuan'])->name('syarat.ketentuan');
Route::get('/kebijakan-peminjaman', [HomeController::class, 'kebijakanPeminjaman'])->name('kebijakan.peminjaman');
Route::get('/proses-pembayaran', [HomeController::class, 'prosesPembayaran'])->name('proses.pembayaran');
Route::get('/proses-pengambilan', [HomeController::class, 'prosesPengambilan'])->name('proses.pengambilan');

// Keranjang Routes (PUBLIC)
Route::prefix('keranjang')->name('keranjang.')->group(function () {
    Route::get('/', [KeranjangController::class, 'index'])->name('index');
    Route::post('/tambah', [KeranjangController::class, 'tambah'])->name('tambah');
    Route::delete('/{id}', [KeranjangController::class, 'hapus'])->name('hapus');
    Route::post('/checkout', [KeranjangController::class, 'checkout'])->name('checkout');
});

// Admin Routes - PROTECTED (Harus login dulu!)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kategori
    Route::resource('kategori', KategoriController::class)->parameters([
        'kategori' => 'id'
    ]);

    // Inventory/Peralatan
    Route::resource('inventory', InventoryController::class)->parameters([
        'inventory' => 'id'
    ]);

    // Paket
    Route::resource('paket', PaketController::class)->parameters([
        'paket' => 'id'
    ]);

    // Promo
    Route::resource('promo', PromoController::class)->parameters([
        'promo' => 'id'
    ]);

    // Orders
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
    });

    // Reporting
    Route::get('/reporting', [ReportingController::class, 'index'])->name('reporting');
    
});

// Auth Routes - HARUS DI PALING BAWAH
require __DIR__.'/auth.php';
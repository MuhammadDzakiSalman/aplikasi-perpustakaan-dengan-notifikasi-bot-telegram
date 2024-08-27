<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;

Route::get('/login', function () { return view('auth.login'); })->name('login');

Route::post('/login', [LoginController::class, 'login']);

    Route::get('/pencarian', [BukuController::class, 'pencarian'])->name('pencarian');
    Route::post('/pencarian', [AnggotaController::class, 'publicStore'])->name('public.store');

    Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('data-buku')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('buku.index');
        Route::post('/', [BukuController::class, 'store'])->name('buku.store');
        Route::post('/', [BukuController::class, 'store'])->name('buku.store');
        Route::delete('/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
        Route::put('/{id_buku}/update', [BukuController::class, 'update'])->name('buku.update');
    });

    Route::prefix('data-anggota')->group(function () {
        Route::get('/', [AnggotaController::class, 'index'])->name('anggota.index');
        Route::post('/', [AnggotaController::class, 'store'])->name('anggota.store');
        Route::delete('/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
        Route::put('/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    });

    Route::prefix('peminjaman')->group(function () {
        Route::get('/', function () {
            return view('peminjaman');
        });
        Route::post('/', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    });

    Route::prefix('pengembalian')->group(function () {
        Route::get('/', [PeminjamanController::class, 'create'])->name('pengembalian.create');
        Route::post('/', [PeminjamanController::class, 'storePengembalian'])->name('pengembalian.store');
    });

    Route::prefix('laporan')->group(function () {
        Route::get('/', [LaporanController::class, 'showLaporan']);
        Route::get('/pdf', 'App\Http\Controllers\LaporanController@downloadPDF')->name('laporan.pdf');
    });

    Route::get('/riwayat', [PeminjamanController::class, 'index'])->name('riwayat');
    Route::get('/detail-riwayat/{id}', [PeminjamanController::class, 'show'])->name('detail-riwayat');

    Route::get('/get-books', [PeminjamanController::class, 'getBooks'])->name('get.books');
    Route::get('/get-members', [PeminjamanController::class, 'getMembers'])->name('get.members');
    Route::get('/get-buku-details', [BukuController::class, 'getBukuDetails'])->name('get.buku.details');
    Route::get('/autocomplete/kodes', [BukuController::class, 'autocomplete'])->name('autocomplete.kodes');
});

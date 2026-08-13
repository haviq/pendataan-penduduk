<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RtPublicController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KartuKKController;
use App\Http\Controllers\ImportTemplateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;

// ── Rate limiter untuk surat generate ─────────
RateLimiter::for('surat', function ($request) {
    return Limit::perMinute(10)->by($request->ip());
});

// ── Portal Publik ──────────────────────────────
Route::get('/', [HomeController::class, 'index']);

// ── RT Publik ──────────────────────────────────
Route::get('/rt', [RtPublicController::class, 'index'])->name('rt.index');
Route::get('/rt/{id}', [RtPublicController::class, 'show'])->name('rt.show');

// ── Import panduan (publik) ────────────────────
Route::get('/import', fn() => view('import.index'))->name('import.index');

// ── Protected routes (perlu login) ────────────
Route::middleware('auth')->group(function () {

    // Surat Keterangan
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::post('/surat/generate', [SuratController::class, 'generate'])
        ->middleware('throttle:surat')
        ->name('surat.generate');

    // Kartu Keluarga
    Route::get('/kartu-kk', [KartuKKController::class, 'index'])->name('kartu_kk.index');
    Route::get('/kartu-kk/{id}/cetak', [KartuKKController::class, 'cetak'])->name('kartu_kk.cetak');
    Route::post('/kartu-kk/bulk', [KartuKKController::class, 'cetakBulk'])->name('kartu_kk.bulk');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf/{jenis}', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/csv/{jenis}', [LaporanController::class, 'exportCsv'])->name('laporan.csv');

    // Import template download
    Route::get('/import/template/resident', [ImportTemplateController::class, 'downloadResidentTemplate'])->name('import.template.resident');
    Route::get('/import/template/household', [ImportTemplateController::class, 'downloadHouseholdTemplate'])->name('import.template.household');
});

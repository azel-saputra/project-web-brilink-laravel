<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

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
    return view('auth/login');
});

// Hapus rute untuk dashboard


// Tambahkan rute untuk halaman create setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TransaksiController::class, 'dashboard'])->middleware('auth')->name('dashboard');
    Route::get('/test', [TransaksiController::class, 'index'])->name('test');
    Route::get('/test/filter', [TransaksiController::class, 'index'])->name('test.filter');
    Route::get('/transaksi/clear', [TransaksiController::class, 'clearFilter']);
    Route::get('/transaksi', [TransaksiController::class, 'transaksi'])->name('transaksi');
    Route::post('/transaksi_store', [TransaksiController::class, 'store'])->name('transaksi_store');
    Route::delete('transaksi/{id_transaksi}', [TransaksiController::class, 'destroy']);

    Route::get('/report', [TransaksiController::class, 'report'])->name('report');
    Route::get('/report/filter', [TransaksiController::class, 'report'])->name('report.filter');

    
});

require __DIR__.'/auth.php';

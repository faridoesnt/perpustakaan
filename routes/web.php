<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\KembaliController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\PinjamController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/peminjaman-buku', [HomeController::class, 'peminjaman'])->name('peminjaman-home');
Route::post('/pinjam-buku/{id}', [HomeController::class, 'pinjam_buku'])->name('pinjam-buku');

Route::get('/login', function() {
    return view('auth.login');
});

// route::resource('buku', BukuController::class)->middleware('admin');

Route::prefix('admin')
        ->middleware(['admin'])
        ->group(function() {

            route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');

            route::resource('buku', BukuController::class);

            route::resource('petugas', PetugasController::class);

            route::resource('anggota', AnggotaController::class);

            route::get('/peminjaman', [PinjamController::class, 'index'])->name('peminjaman');
            route::post('/terima-peminjaman/{id}', [PinjamController::class, 'terima_peminjaman'])->name('terima-peminjaman');
            route::post('/kembali-peminjaman/{id}', [PinjamController::class, 'kembali_peminjaman'])->name('kembali-peminjaman');
            
            route::get('/pengembalian', [KembaliController::class, 'index'])->name('pengembalian');
        });
Auth::routes();
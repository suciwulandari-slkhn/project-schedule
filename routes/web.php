<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\UproleController;
use App\Http\Controllers\UserControlController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function(){
    Route::view("/", "landingPage/index");
    Route::get('/sesi', [AuthController::class, 'index'])->name('auth');
    Route::post('/sesi', [AuthController::class, 'login']);
    Route::get('/reg', [AuthController::class, 'create'])-> name('registrasi');
    Route::post('/reg', [AuthController::class, 'register']);
    Route::get('/verify/{verify_key}',[AuthController::class, 'verify']);
    
});

Route::middleware(['auth'])->group(function(){
    Route::redirect('/home', '/user');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('userAkses:admin');
    Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('userAkses:user');

    //JADWAL
    Route::get('/jadwal',[JadwalController::class, 'index'])->name('jadwal');
    Route::get('/jadwalTambah', [JadwalController::class, 'tambah']);
    Route::get('/jadwalEdit/{id}', [JadwalController::class, 'edit']);
    Route::post('/jadwalHapus/{id}', [JadwalController::class, 'hapus']);

    Route::post('/tambahJadwal', [JadwalController::class, 'create']);
    Route::post('/editJadwal', [JadwalController::class, 'change']);

    //KATEGORI
    Route::get('/kategori',[KategoriController::class, 'index'])->name('kategori');    
    Route::get('/kategoriTambah', [KategoriController::class, 'tambah']);
    Route::get('/kategoriEdit/{id}', [KategoriController::class, 'edit']);
    Route::post('/kategoriHapus/{id}', [KategoriController::class, 'hapus']);

    Route::post('/tambahKategori', [KategoriController::class, 'create']);
    Route::post('/editKategori', [KategoriController::class, 'change']);

    //USER CONTROL
    Route::get('/userControl',[UserControlController::class, 'index'])->name('userControl');

    Route::get('/tambahUser', [UserControlController::class, 'tambah']);
    Route::get('/editUser/{id}', [UserControlController::class, 'edit']);
    Route::post('/hapusUser/{id}', [UserControlController::class, 'hapus']);
    Route::post('/tambahUser', [UserControlController::class, 'create']);
    Route::post('/editUser', [UserControlController::class, 'change']);

    Route::post('/uprole/{id}', [UproleController::class, 'index']);

    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    //Search    
    Route::post('/search', [SearchController::class, 'search'])->name('search');
    Route::post('/filter-by-category', [SearchController::class, 'filterByCategory'])->name('filterByCategory');

    //Notifikasi
    Route::get('/jadwal-hari-ini', [JadwalController::class, 'JadwalHariIni'])->name('jadwal_hari_ini');

});


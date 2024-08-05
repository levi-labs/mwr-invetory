<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    if (auth()->check()) {
        return view('pages.dashboard.index');
    } else {
        return view('pages.auth.login');
    }
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('edit-password', 'editPassword')->name('edit-password');
        Route::put('update-password', 'updatePassword')->name('update-password');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
        Route::get('/', 'index')->name('kategori.index');
        Route::post('/search', 'index')->name('kategori.search');
        Route::get('/create', 'create')->name('kategori.create');
        Route::get('/show/{kategori}', 'show')->name('kategori.show');
        Route::post('/store', 'store')->name('kategori.store');
        Route::get('/edit/{kategori}', 'edit')->name('kategori.edit');
        Route::put('/update/{kategori}', 'update')->name('kategori.update');
        Route::delete('delete/{kategori}', 'destroy')->name('kategori.delete');
    });

    Route::controller(BarangController::class)->prefix('barang')->group(function () {
        Route::get('/', 'index')->name('barang.index');
        Route::post('/search', 'index')->name('barang.search');
        Route::get('/create', 'create')->name('barang.create');
        Route::get('/show/{barang}', 'show')->name('barang.show');
        Route::post('/store', 'store')->name('barang.store');
        Route::get('/edit/{barang}', 'edit')->name('barang.edit');
        Route::put('/update/{barang}', 'update')->name('barang.update');
        Route::delete('delete/{barang}', 'destroy')->name('barang.delete');
    });
    Route::controller(BarangMasukController::class)->prefix('barang-masuk')->group(function () {
        Route::get('/', 'index')->name('barang-masuk.index');
        Route::post('/search', 'index')->name('barang-masuk.search');
        Route::get('/create', 'create')->name('barang-masuk.create');
        Route::get('/show/{barangMasuk}', 'show')->name('barang-masuk.show');
        Route::post('/store', 'store')->name('barang-masuk.store');
        Route::get('/edit/{barangMasuk}', 'edit')->name('barang-masuk.edit');
        Route::put('/update/{barangMasuk}', 'update')->name('barang-masuk.update');
        Route::delete('delete/{barangMasuk}', 'destroy')->name('barang-masuk.delete');
    });

    Route::controller(BarangKeluarController::class)->prefix('barang-keluar')->group(function () {
        Route::get('/', 'index')->name('barang-keluar.index');
        Route::post('/search', 'index')->name('barang-keluar.search');
        Route::get('/create', 'create')->name('barang-keluar.create');
        Route::get('/show/{barangKeluar}', 'show')->name('barang-keluar.show');
        Route::post('/store', 'store')->name('barang-keluar.store');
        Route::get('/edit/{barangKeluar}', 'edit')->name('barang-keluar.edit');
        Route::put('/update/{barangKeluar}', 'update')->name('barang-keluar.update');
        Route::delete('delete/{barangKeluar}', 'destroy')->name('barang-keluar.delete');

        Route::get('/create-analysis', 'createAnalysis')->name('barang-keluar.create-analysis');
        Route::post('/store-analysis', 'storeAnalysis')->name('barang-keluar.store-analysis');
    });

    Route::controller(SupplierController::class)->prefix('supplier')->group(function () {
        Route::get('/', 'index')->name('supplier.index');
        Route::post('/search', 'index')->name('supplier.search');
        Route::get('/create', 'create')->name('supplier.create');
        Route::get('/show/{supplier}', 'show')->name('supplier.show');
        Route::post('/store', 'store')->name('supplier.store');
        Route::get('/edit/{supplier}', 'edit')->name('supplier.edit');
        Route::put('/update/{supplier}', 'update')->name('supplier.update');
        Route::delete('delete/{supplier}', 'destroy')->name('supplier.delete');
    });

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('users.index');
        Route::get('/create', 'create')->name('users.create');
        Route::get('/show/{user}', 'show')->name('users.show');
        Route::post('/store', 'store')->name('users.store');
        Route::get('/edit/{user}', 'edit')->name('users.edit');
        Route::put('/update/{user}', 'update')->name('users.update');
        Route::delete('delete/{user}', 'destroy')->name('users.delete');
        Route::get('/reset-password/{user}', 'resetPassword')->name('users.reset-password');
    });
});

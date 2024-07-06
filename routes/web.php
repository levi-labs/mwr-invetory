<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
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
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
    Route::get('/', 'index')->name('kategori.index');
    Route::get('/create', 'create')->name('kategori.create');
    Route::get('/show/{kategori}', 'show')->name('kategori.show');
    Route::post('/store', 'store')->name('kategori.store');
    Route::get('/edit/{kategori}', 'edit')->name('kategori.edit');
    Route::put('/update/{kategori}', 'update')->name('kategori.update');
    Route::delete('delete/{kategori}', 'destroy')->name('kategori.delete');
});

Route::controller(BarangController::class)->prefix('barang')->group(function () {
    Route::get('/', 'index')->name('barang.index');
    Route::get('/create', 'create')->name('barang.create');
    Route::get('/show/{barang}', 'show')->name('barang.show');
    Route::post('/store', 'store')->name('barang.store');
    Route::get('/edit/{barang}', 'edit')->name('barang.edit');
    Route::put('/update/{barang}', 'update')->name('barang.update');
    Route::delete('delete/{brang}', 'destroy')->name('barang.destroy');
});

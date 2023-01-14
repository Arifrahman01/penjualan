<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;

use Illuminate\Support\Facades\Route;

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
    return redirect('/home');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/transaksi', 'index')->name('transaksi.index');
        Route::get('/transaksi/create', 'create')->name('transaksi.create');
        Route::get('/transaksi/{id}/edit', 'edit')->name('transaksi.edit');
        Route::get('/transaksi/{id}/delete', 'destroy')->name('transaksi.destroy');
        Route::post('/transaksi', 'store')->name('transaksi.store');
        Route::put('/transaksi/{id}/update', 'update')->name('transaksi.update');
    });

    Route::controller(BarangController::class)->group(function () {
        Route::get('/barang', 'index')->name('barang.index');
        Route::get('/barang/create', 'create')->name('barang.create');
        Route::get('/barang/{id}/edit', 'edit')->name('barang.edit');
        Route::get('/barang/{id}/delete', 'destroy')->name('barang.destroy');
        Route::post('/barang', 'store')->name('barang.store');
        Route::put('/barang/{id}/update', 'update')->name('barang.update');
    });

    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier', 'index')->name('supplier.index');
        Route::get('/supplier/create', 'create')->name('supplier.create');
        Route::get('/supplier/{id}/edit', 'edit')->name('supplier.edit');
        Route::get('/supplier/{id}/delete', 'destroy')->name('supplier.destroy');
        Route::post('/supplier', 'store')->name('supplier.store');
        Route::put('/supplier/{id}/update', 'update')->name('supplier.update');
    });

});
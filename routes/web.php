<?php

use App\Http\Controllers\BarangController;
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

    Route::controller(BarangController::class)->group(function () {
        Route::get('/barang', 'index')->name('barang.index');
        Route::get('/barang/create', 'create')->name('barang.create');
        Route::get('/barang/{id}/edit', 'edit')->name('barang.edit');
        Route::get('/barang/{id}/delete', 'destroy')->name('barang.destroy');
        
        Route::post('/barang', 'store')->name('barang.store');
        Route::put('/barang/{id}/update', 'update')->name('barang.update');
    });

});
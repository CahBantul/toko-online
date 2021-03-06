<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/', \App\Http\Livewire\Home::class);
Route::get('/tambah-produk', \App\Http\Livewire\TambahProduk::class);
Route::get('/belanja-user', \App\Http\Livewire\BelanjaUser::class);
Route::get('/tambah-ongkir/{id}', \App\Http\Livewire\TambahOngkir::class);
Route::get('/bayar/{id}', \App\Http\Livewire\Bayar::class);
Route::post('/webhooks', [\App\Http\Controllers\Api::class, 'test']);
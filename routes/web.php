<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BukuController;

Route::get('/', [TestController::class, 'beranda']);
Route::get('/about', [TestController::class, 'about']);
Route::get('/index', [TestController::class, 'index']);

//* PERTEMUAN 4
Route::get('/boom', [TestController::class, 'boomesport']);
Route::get('/prx', [TestController::class, 'prxesport']);
Route::get('/fnatic', [TestController::class, 'fnaticesport']);
Route::get('/fpx', [TestController::class, 'fpxesport']);


//* PERTEMUAN 5
// Route::get('/buku', 'BukuController@index'); CARA LARAVEL 7
Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
Route::post('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

// * EDIT
Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');

// * UPDATE
Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');

//* SEARCH
Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

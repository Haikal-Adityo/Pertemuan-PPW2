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

// Route::get('/buku', 'BukuController@index'); LARAVEL 7
Route::get('/buku', [BukuController::class, 'index']);
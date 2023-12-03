<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\RatingController;

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
// Route::get('/buku', [BukuController::class, 'index']);
// Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
// Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
// Route::post('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

// // * EDIT
// Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');

// // * UPDATE
// Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');

// // * SEARCH
// Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/buku/list', [BukuController::class, 'list'])->name('buku.list');
    Route::get('/buku/list/search', [BukuController::class, 'listSearch'])->name('buku.listSearch');

    Route::get('/buku/detail/{id}', [BukuController::class, 'detailBuku'])->name('buku.detail');
    Route::post('/buku/detail/{id}/rate', [RatingController::class, 'ratingBuku'])->name('buku.rating');

    Route::get('/buku/favourite', [BukuController::class, 'showFavouriteBuku'])->name('buku.showFavourite');
    Route::post('/buku/favourite/{id}', [FavouriteController::class, 'favouriteBuku'])->name('buku.favourite');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {

        Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        
        Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::post('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
        Route::post('/buku/edit/{id}/delete-image/{image_id}', [BukuController::class, 'destroyImage'])->name('buku.destroyImage');
        
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/buku/favourite', [BukuController::class, 'showFavouriteBuku'])->name('buku.showFavourite');

    Route::get('/buku/detail/{id}', [BukuController::class, 'detailBuku'])->name('buku.detail');
    Route::post('/buku/detail/{id}/favourite', [FavouriteController::class, 'favouriteBuku'])->name('buku.favourite');
});

require __DIR__.'/auth.php';
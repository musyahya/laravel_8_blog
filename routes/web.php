<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BannerControler;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\PembacaController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\UserController;
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


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/cek-role', function () {
    if (auth()->user()->hasRole(['admin', 'penulis'])) {
        return redirect('/dashboard');
    } else {
        return redirect('/');
    }
    
});

Route::group(['middleware' => ['verified', 'role:admin|penulis']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('/kategori', KategoriController::class);
    Route::post('/kategori/search', [KategoriController::class, 'index']);

    Route::resource('/tag', TagController::class);
    Route::post('/tag/search', [TagController::class, 'index']);

    Route::resource('/logo', LogoController::class);
    Route::resource('/tentang', TentangController::class);

    Route::resource('/post', PostController::class);
    Route::get('/post/{id}/konfirmasi', [PostController::class, 'konfirmasi']);
    Route::get('/post/{id}/delete', [PostController::class, 'delete']);
    Route::get('/post/{id}/rekomendasi', [PostController::class, 'rekomendasi']);
    Route::post('/post/search', [PostController::class, 'index']);

    Route::resource('/banner', BannerControler::class);
    Route::get('/banner/{id}/konfirmasi', [BannerControler::class, 'konfirmasi']);
    Route::get('/banner/{id}/delete', [BannerControler::class, 'delete']);
    Route::post('/banner/search', [BannerControler::class, 'index']);

    Route::get('/footer', [FooterController::class, 'index']);
    Route::patch('/footer/{id}', [FooterController::class, 'update']);

    Route::get('/user/{id}/setting', [UserController::class, 'setting']);
    Route::patch('/user/{id}/setting', [UserController::class, 'ubah_password']);

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('/penulis', PenulisController::class);
        Route::get('/penulis/{id}/konfirmasi', [PenulisController::class, 'konfirmasi']);
        Route::get('/penulis/{id}/delete', [PenulisController::class, 'delete']);
        Route::post('/penulis/search', [PenulisController::class, 'index']);

        Route::resource('/pembaca', PembacaController::class);
        Route::post('/pembaca/search', [PembacaController::class, 'index']);
    });
});

Route::get('/', [ArtikelController::class, 'index']);
Route::get('/artikel-tentang', [ArtikelController::class, 'tentang']);
Route::get('/{slug}', [ArtikelController::class, 'artikel']);
Route::get('/artikel-kategori/{slug}', [ArtikelController::class, 'kategori']);
Route::get('/artikel-tag/{slug}', [ArtikelController::class, 'tag']);
Route::get('/artikel-banner/{slug}', [ArtikelController::class, 'banner']);
Route::get('/artikel-author/{id}', [ArtikelController::class, 'author']);

Route::middleware(['verified', 'role:pembaca'])->group(function () {
    Route::get('/like/{id}', [LikeController::class, 'like']);
});
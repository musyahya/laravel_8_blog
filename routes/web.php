<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BannerControler;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TentangController;
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



Route::get('/dashboard', function () {
    return view('admin/dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/kategori', KategoriController::class);
Route::resource('/tag', TagController::class);
Route::resource('/logo', LogoController::class);
Route::resource('/tentang', TentangController::class);

Route::resource('/post', PostController::class);
Route::get('/post/{id}/konfirmasi', [PostController::class, 'konfirmasi']);
Route::get('/post/{id}/delete', [PostController::class, 'delete']);

Route::resource('/banner', BannerControler::class);
Route::get('/banner/{id}/konfirmasi', [BannerControler::class, 'konfirmasi']);
Route::get('/banner/{id}/delete', [BannerControler::class, 'delete']);

Route::get('/footer', [FooterController::class, 'index']);
Route::patch('/footer/{id}', [FooterController::class, 'update']);

Route::get('/', [ArtikelController::class, 'index']);
Route::get('/artikel-tentang', [ArtikelController::class, 'tentang']);
Route::get('/{slug}', [ArtikelController::class, 'artikel']);
Route::get('/artikel-kategori/{slug}', [ArtikelController::class, 'kategori']);
Route::get('/artikel-tag/{slug}', [ArtikelController::class, 'tag']);
Route::get('/artikel-banner/{slug}', [ArtikelController::class, 'banner']);

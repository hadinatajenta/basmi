<?php

use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\HargaIklanController;
use App\Http\Controllers\IklanBannerController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailController;
use App\Models\Halaman;

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

//Welcome
Route::get('/',[LandingPageController::class,'index'])->name('welcome');

//Auth
Auth::routes();

Route::prefix('admin')->group(function(){
    //Halaman home dashboard admin
    Route::prefix('home')->group(function(){
        Route::get('/', [BeritaController::class, 'index'])->name('home');
        Route::delete('/{id}', [BeritaController::class,'delete'])->name('hapus-berita');
        Route::post('/berita/featured/{id}', [BeritaController::class, 'toggleFeatured'])->name('berita.toggleFeatured');
    });
    //Postingan baru
    Route::prefix('postingan-baru')->group(function () {
        Route::get('/', [BeritaController::class, 'add'])->name('add-post');
        Route::post('/', [BeritaController::class, 'store'])->name('store-post');
    });

    //Edit berita
    Route::prefix('edit-berita')->group(function(){
        Route::get('/{id}',[BeritaController::class,'edit'])->name('edit-post');
        Route::put('/{id}',[BeritaController::class,'update'])->name('update-post');
    });
    //Hapus berita

    // manajemen pengguna
    Route::prefix('/pengguna')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('users.home');
        Route::post('/',[UserController::class,'store'])->name('users.store');
        Route::delete('/{id}',[UserController::class,'delete'])->name('users.delete');
        Route::get('/detail-karyawan/{id}',[UserDetailController::class,'edit'])->name('user.edit');
        Route::put('/detail-karyawan/{id}',[UserDetailController::class,'update'])->name('user.update');
    });
    //Kategori admin
    Route::prefix('/kategori')->group(function () {
        Route::delete('/selected-id', [CategoriesController::class, 'destroyAll'])->name('kategori.all');
        Route::get('/', [CategoriesController::class, 'index'])->name('kategori');
        Route::post('/', [CategoriesController::class, 'store'])->name('kategori.store');
        Route::put('/{id}', [CategoriesController::class, 'update'])->name('kategori.update');
        Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('kategori.destroy');
    });
    //manajemen halaman
    Route::prefix('halaman')->group(function () {
        Route::get('/', [HalamanController::class, 'index'])->name('halaman');
        Route::get('/add-page',[HalamanController::class,'create'])->name('halaman.add');
        Route::post('/add-page',[HalamanController::class,'store'])->name('halaman.store');
        Route::get('/edit/{id}',[HalamanController::class,'edit'])->name('halaman.edit');
        Route::put('/edit/{id}',[HalamanController::class,'update'])->name('halaman.update');
        Route::delete('/{id}', [HalamanController::class, 'destroy'])->name('halaman.hapus');
    });
    //Sponsorship
    Route::prefix('sponsorship')->group(function () {
        Route::get('/', [SponsorshipController::class, 'index'])->name('sponsorship');
        Route::put('/{id}', [SponsorshipController::class, 'update'])->name('sponsorship.update');
    });

});
Route::prefix('/')->group(function(){
    Route::get('/kategori/{nama_kategori}', [CategoriesController::class, 'showCategory'])->name('showCategory');
    Route::get('{slug}', [HalamanController::class, 'showHalaman'])->name('showHalaman');
    Route::get('/{nama_kategori}/{slug}', [LandingPageController::class, 'show'])->name('show');
});




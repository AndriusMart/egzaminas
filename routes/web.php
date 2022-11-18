<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController as C;
use App\Http\Controllers\BookController as B;
use App\Http\Controllers\HomeController as H;
use App\Http\Controllers\OrderController as O;
use App\Http\Controllers\LikeController as L;

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



Auth::routes();

Route::get('/', [H::class, 'homeList'])->name('home')->middleware('gate:home');
Route::put('/rate/{book}', [H::class, 'rate'])->name('rate')->middleware('gate:user');





Route::prefix('category')->name('c_')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index')->middleware('gate:user');
    Route::get('/create', [C::class, 'create'])->name('create')->middleware('gate:admin');
    Route::post('/create', [C::class, 'store'])->name('store')->middleware('gate:admin');
    Route::get('/show/{category}', [C::class, 'show'])->name('show')->middleware('gate:user');
    Route::delete('/delete/{category}', [C::class, 'destroy'])->name('delete')->middleware('gate:admin');
    Route::get('/edit/{category}', [C::class, 'edit'])->name('edit')->middleware('gate:admin');
    Route::put('/edit/{category}', [C::class, 'update'])->name('update')->middleware('gate:admin');
});

Route::prefix('book')->name('b_')->group(function () {
    Route::get('/', [B::class, 'index'])->name('index')->middleware('gate:user');
    Route::get('/create', [B::class, 'create'])->name('create')->middleware('gate:admin');
    Route::post('/create', [B::class, 'store'])->name('store')->middleware('gate:admin');
    Route::get('/show/{book}', [B::class, 'show'])->name('show')->middleware('gate:user');
    Route::delete('/delete/{book}', [B::class, 'destroy'])->name('delete')->middleware('gate:admin');
    Route::get('/edit/{book}', [B::class, 'edit'])->name('edit')->middleware('gate:admin');
    Route::put('/edit/{book}', [B::class, 'update'])->name('update')->middleware('gate:admin');
});

Route::prefix('order')->name('o_')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('gate:user');
    Route::post('/create', [O::class, 'store'])->name('store')->middleware('gate:user');
    Route::delete('/delete/{order}', [O::class, 'destroy'])->name('delete')->middleware('gate:admin');
});

Route::prefix('like')->name('l_')->group(function () {
    Route::get('/', [L::class, 'index'])->name('index')->middleware('gate:user');
    Route::post('/create', [L::class, 'store'])->name('store')->middleware('gate:user');
    Route::delete('/delete/{like}', [L::class, 'destroy'])->name('delete')->middleware('gate:user');
});

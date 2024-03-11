<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;

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
Auth::routes();
Route::middleware(["ProductMiddleware"])->group(
    function () {
        Route::resource('product', ProductController::class);
    }
);
Route::patch('product/restore/{product}', [ProductController::class, 'restore'])->withTrashed()->name('restore');
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('product', ProductController::class)
    ->missing(function () {
        return Redirect::route('index');
    });
Route::get('home/archive', [HomeController::class, 'archive'])->name('archive');
Route::get('/search', [SearchController::class, 'search'])->name('search');


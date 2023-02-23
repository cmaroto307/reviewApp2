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

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\ReviewController::class, 'index']);
Route::get('reviews/film', [App\Http\Controllers\ReviewController::class, 'films'])->name('films');
Route::get('reviews/book', [App\Http\Controllers\ReviewController::class, 'books'])->name('books');
Route::get('reviews/record', [App\Http\Controllers\ReviewController::class, 'records'])->name('records');

Route::resource('review', App\Http\Controllers\ReviewController::class);
Route::resource('comment', App\Http\Controllers\CommentController::class);

Route::get('home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::put('user/update', [App\Http\Controllers\HomeController::class, 'update'])->name('user.update');

Route::resource('admin', App\Http\Controllers\AdministrationController::class);
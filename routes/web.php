<?php

use App\Http\Controllers\articlesController;
use App\Http\Controllers\commentsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [articlesController::class, 'home']);

Route::get('articles/search', [articlesController::class, 'search'])->name('articles.search');
Route::resource('articles', articlesController::class)->middleware('auth');
Route::post('articles/{article}/comment', [CommentsController::class, 'store'])->name('articles.comments.store');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

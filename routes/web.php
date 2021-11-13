<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostController;
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


Route::get('/', [HomeController::class,'index'])->name('post.home');
Route::get('/post/create/', [PostController::class,'create'])->name('post.create');
Route::post('/post', [PostController::class,'store'])->name('post');

Route::get('profiles/{user_id}',[ProfilesController::class, 'index'])->name('profiles.show');

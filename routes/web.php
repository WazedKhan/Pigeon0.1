<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AnonymousController;
use App\Http\Controllers\UserController;



Route::get('/', [HomeController::class,'index'])->name('post.home');
Route::get('/post/create/', [PostController::class,'create'])->name('post.create');
Route::post('/post', [PostController::class,'store'])->name('post');

Route::get('profiles/{user_id}',[ProfilesController::class, 'index'])->name('profiles.show');
Route::get('/register', [UserController::class, 'registerView'])->name('register');
//Route::get('/register/create', [UserController::class, 'register'])->name('register.create');

Route::prefix('/anonymous')->group(function () {
    Route::get('/', [AnonymousController::class, 'index'])->name('anonymous.index');
    Route::get('/create', [AnonymousController::class, 'create'])->name('anonymous.create');
    Route::post('/store', [AnonymousController::class, 'store'])->name('anonymous.store');
    Route::post('/search/result/',[AnonymousController::class, 'search'])->name('search');
});
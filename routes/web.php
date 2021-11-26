<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AnonymousController;
use App\Http\Controllers\UserController;

Route::get('/', [PostController::class,'index'])->name('post.home');


Route::prefix('post')->group(function () {
    Route::get('/create/', [PostController::class,'create'])->name('post.create');
    Route::post('/store/', [PostController::class,'store'])->name('post'); 
});


Route::prefix('profile/')->group(function () {
    Route::get('/{user_id}',[ProfilesController::class, 'index'])->name('profile.show');
    Route::get('/{user_id}/edit', [ProfilesController::class, 'edit'])->name('profile.edit');
    Route::patch('/{user_id}', [ProfilesController::class, 'update'])->name('profile.update');
});


Route::get('/register', [UserController::class, 'registerForm'])->name('register');
Route::post('create/user', [UserController::class, 'storeUser'])->name('create.user');
Route::get('login/', [UserController::class, 'LoginView'])->name('login');
Route::post('signin/', [UserController::class, 'signIn'])->name('signin');
Route::get('logout/', [UserController::class, 'logout'])->name('logout');

//Route::get('/register/create', [UserController::class, 'register'])->name('register.create');

Route::prefix('/anonymous')->group(function () {
    Route::get('/', [AnonymousController::class, 'index'])->name('anonymous.index');
    Route::get('/create', [AnonymousController::class, 'create'])->name('anonymous.create');
    Route::post('/store', [AnonymousController::class, 'store'])->name('anonymous.store');
    Route::post('/search/result/',[AnonymousController::class, 'search'])->name('search');
});
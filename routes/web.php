<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AnonymousController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FollowController;

Route::get('/', [HomeController::class,'post'])->name('home');



Route::prefix('post/')->group(function () {
    Route::get('/', [PostController::class,'index'])->name('post.home');
    Route::get('/create/', [PostController::class,'create'])->name('post.create');
    Route::post('/store/', [PostController::class,'store'])->name('post'); 
    Route::get('/{post_id}/', [PostController::class, 'detailView'])->name('post.detail');
    Route::get('/view/{post_id}', [PostController::class, 'updateView'])->name('post.updateView');
    Route::patch('/view/{post_id}/update', [PostController::class, 'update'])->name('post.update');
    Route::get('/kill/{post_id}/', [PostController::class, 'delete'])->name('post.delete');
    Route::get('/like/{post_id}/', [PostController::class, 'like'])->name('post.like');
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
});

// Searching Routes 

Route::get('/search/',[AnonymousController::class, 'search'])->name('search');

// Following Routes 
Route::get('/follow/{user_id}', [FollowController::class, 'addFollow'])->name('follow');
Route::get('/unfollow/{user_id}', [FollowController::class, 'unFollow'])->name('unfollow');

Route::prefix('/admin/')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/posts', [AdminController::class, 'posts'])->name('admin.posts');//->name('anonymous.index');
});
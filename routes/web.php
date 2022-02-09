<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExtraFeature;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\AnonymousController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\UserController as Users;

Route::get('/', [HomeController::class,'post'])->name('home');

Route::get('/notification', [NotificationController::class,'index'])->name('notifications');

Route::prefix('post/')->group(function () {
    Route::get('/', [PostController::class,'index'])->name('post.home');
    Route::get('/create/', [PostController::class,'create'])->name('post.create');
    Route::post('/store/', [PostController::class,'store'])->name('post');
    Route::get('/{post_id}/', [PostController::class, 'detailView'])->name('post.detail');
    Route::get('/view/{post_id}', [PostController::class, 'updateView'])->name('post.updateView');
    Route::patch('/view/{post_id}/update', [PostController::class, 'update'])->name('post.update');
    Route::get('/kill/{post_id}/', [PostController::class, 'delete'])->name('post.delete');
    Route::get('/like/{post_id}/', [PostController::class, 'like'])->name('post.like');
    Route::get('/{post_id}/form', [PostController::class, 'commnetCreateV'])->name('post.comment');
    Route::post('/{post_id}/make', [PostController::class, 'makeComment'])->name('post.comment.make');
    Route::get('/like/{post_id}/list', [PostController::class, 'viewLikes'])->name('post.likers');
    Route::get('/photo/{id}/delete', [PostController::class, 'deleteImage'])->name('post.image.delete');
    Route::post('/report/{post_id}', [PostController::class, 'makeReport'])->name('post.report');
});


Route::prefix('profile/')->group(function () {
    Route::get('/{user_id}',[ProfilesController::class, 'index'])->name('profile.show');
    Route::get('/{user_id}/edit', [ProfilesController::class, 'edit'])->name('profile.edit');
    Route::patch('/{user_id}', [ProfilesController::class, 'update'])->name('profile.update');
    Route::get('/{user_id}/followers', [ProfilesController::class, 'friends'])->name('profile.followers');
});


Route::get('/register', [UserController::class, 'registerForm'])->name('register');
Route::post('create/user', [UserController::class, 'storeUser'])->name('create.user');
Route::get('login/', [UserController::class, 'LoginView'])->name('login');
Route::post('signin/', [UserController::class, 'signIn'])->name('signin');
Route::get('logout/', [UserController::class, 'logout'])->name('logout');


// Useless Routes 
Route::prefix('/anonymous')->group(function () {
    Route::get('/', [AnonymousController::class, 'index'])->name('anonymous.index');
    Route::get('/create', [AnonymousController::class, 'create'])->name('anonymous.create');
    Route::post('/store', [AnonymousController::class, 'store'])->name('anonymous.store');
});

// Searching Routes

Route::get('/search/',[ExtraFeature::class, 'search'])->name('search');

// Following Routes
Route::get('/follow/{user_id}', [FollowController::class, 'addFollow'])->name('follow');
Route::get('/unfollow/{user_id}', [FollowController::class, 'unFollow'])->name('unfollow');
Route::get('friends/suggestions',[ExtraFeature::class, 'suggest'])->name('suggest');

// Chat Routes
Route::get('chat/',[ChatController::class,'index'])->name('chat');
Route::get('chat/user/{id}',[ChatController::class,'chat'])->name('chat.user');
Route::post('chat/text/{id}',[ChatController::class,'addText'])->name('chat.text');

// Admin's Routes
Route::prefix('/admin/')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::get('/user', [Users::class, 'index'])->name('admin.user.index');
    Route::patch('/user/status/{id}', [Users::class, 'status'])->name('admin.user.changeStatus');
    Route::get('/reports', [AdminController::class, 'reportCategorylist'])->name('admin.report.list');
    Route::post('/reports/create', [AdminController::class, 'reportCategorycreate'])->name('admin.report.create');
});

// Password Reset Routes
Route::get('/reset/Password', function () {
    return view('auth.forgot_password');
});
Route::post('/password/mail', [PasswordController::class, 'send'])->name('send.mail');
Route::get('/password/reset/{token}/{email}', [PasswordController::class, 'resetView'])->name('pass.reset');
Route::post('/password/reset/', [PasswordController::class, 'resetPassword'])->name('reset.password');

// Group Routes
Route::prefix('/group/')->group(function(){
    Route::get('/', [ExtraFeature::class, 'showGroups'])->name('groups');
    Route::get('create/', [ExtraFeature::class, 'groupCreateView'])->name('create.group');
    Route::post('create/store', [ExtraFeature::class, 'createGroup'])->name('store.group');
});

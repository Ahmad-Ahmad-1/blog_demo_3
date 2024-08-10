<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProfileController;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/', [PostController::class, 'latestPosts'])->name('home');
Route::resource('/posts', PostController::class)->only('index');
Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::patch('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update_password');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  
  Route::get('/posts/my-posts', [PostController::class, 'myPosts'])->name('posts.my_posts');
  Route::resource('/posts', PostController::class)->except(['show', 'index']);
  
  Route::get('/roles/search', [RoleController::class, 'search'])->name('roles.search');
  Route::resource('/roles', RoleController::class);

  Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
  Route::resource('/users', UserController::class);
});

Route::resource('/posts', PostController::class)->only('show');

// Route::get('/app', function () {
//   return view('roles.index');
// });

/*
  Roles:

  - will sessions work on create and edit files?

  store: route not found.

*/
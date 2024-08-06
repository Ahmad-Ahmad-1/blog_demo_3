<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\PostController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/', [PostController::class, 'latestPosts'])->name('home');

Route::middleware('auth:sanctum')->group(function () {

//   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
  Route::get('/posts/my-posts', [PostController::class, 'myPosts'])->name('posts.my_posts');
  Route::resource('/posts', PostController::class)->except(['show']);

//   Route::get('/roles/search', [RoleController::class, 'search'])->name('roles.search');
//   Route::resource('/roles', RoleController::class);

//   Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
//   Route::resource('/users', UserController::class);
});

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');

// Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

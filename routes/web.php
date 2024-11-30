<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index']);

Route::get('posts/{archive?}' , [PostController::class , 'index'])->name('posts.index');
Route::get('posts/show/{post}' , [PostController::class , 'show'])->name('posts.show');

Route::middleware(['auth' , 'can:admin'])->prefix('admin/')->group(function () {
    Route::resource('posts', PostController::class)->except(['show' , 'index']);
    Route::get('posts/categories' , [CategoryController::class, 'index'])->name('post.categories');
    Route::post('posts/categories' , [CategoryController::class, 'store'])->name('post.categories.store');
    Route::delete('posts/categories/{category}' , [CategoryController::class, 'destroy'])->name('post.categories.delete');
});

Route::resource('posts.comments', CommentController::class)->only(['store' , 'destroy'])->middleware('auth');

Route::post('posts/{post}/like', [PostLikeController::class, 'like'])->middleware('auth')->name('posts.like');
Route::post('posts/{post}/unlike', [PostLikeController::class, 'unlike'])->middleware('auth')->name('posts.unlike');
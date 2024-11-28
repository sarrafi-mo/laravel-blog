<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index']);
Route::get('post-details', [PostController::class, 'show']);
Route::get('post-create', [PostController::class, 'create']);
Route::get('post-edit', [PostController::class, 'edit']);
Route::get('category', [CategoryController::class, 'index']);


Route::get('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'register']);
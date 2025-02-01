<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/posts', [PostController::class, 'index']);

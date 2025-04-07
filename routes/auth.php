<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('login.post');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'register'])->middleware('verification.timeout')->name('register');
Route::post('register', [AuthController::class, 'store'])->name('register.post');

Route::get('email-verify', [AuthController::class, 'verifyEmailPage'])->name('email.verify');
Route::post('email-verify', [AuthController::class, 'verifyEmail'])->name('email.verify.submit');
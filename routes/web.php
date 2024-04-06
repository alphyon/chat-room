<?php

use Illuminate\Support\Facades\Route;

Route::get('/login',[\App\Http\Controllers\AuthController::class,'showLoginForm'])->name('login');
Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);
Route::post('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
Route::get('/register',[\App\Http\Controllers\AuthController::class,'showRegisterForm'])->name('register');
Route::post('/register',[\App\Http\Controllers\AuthController::class,'register']);

Route::get('/',[\App\Http\Controllers\ChatController::class,'index'])->name('chat');
Route::post('/chat/send',[\App\Http\Controllers\ChatController::class,'sendMessage'])->name('chat.send')->middleware('auth');

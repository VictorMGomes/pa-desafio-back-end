<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users/{ID}', [UserController::class, 'show']);
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{ID}', [UserController::class, 'update']);

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{ID}', [PostController::class, 'show']);
Route::post('/posts', [PostController::class, 'store']);
Route::put('/posts/{ID}', [PostController::class, 'update']);
Route::delete('/posts/{ID}', [PostController::class, 'destroy']);

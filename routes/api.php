<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/users/{ID}', [UserController::class, 'get']);
Route::get('/users', [UserController::class, 'getAll']);
Route::post('/users', [UserController::class, 'create']);
Route::put('/users/{ID}', [UserController::class, 'update']);

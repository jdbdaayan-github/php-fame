<?php

use App\Controllers\HomeController;
use System\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/login', [HomeController::class, 'login']);

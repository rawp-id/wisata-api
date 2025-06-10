<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/images/{path}', [StorageController::class, 'images'])->where('path', '.*');
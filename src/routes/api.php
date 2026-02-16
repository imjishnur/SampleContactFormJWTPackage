<?php

use Illuminate\Support\Facades\Route;
use Vendor\ContactForm\Http\Controllers\ContactController;
use Vendor\ContactForm\Http\Controllers\AuthController;

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('contact', [ContactController::class, 'store']);
    Route::get('contact', [ContactController::class, 'index']);
});

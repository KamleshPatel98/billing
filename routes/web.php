<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

//AuthController
Route::get('register',[AuthController::class,'register_form']);
Route::post('register',[AuthController::class,'register']);
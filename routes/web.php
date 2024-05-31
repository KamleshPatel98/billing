<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PurchaseController;

Route::get('/', function () {
    return view('welcome');
});

//AuthController
Route::get('register',[AuthController::class,'register_form'])->name('register');
Route::post('register',[AuthController::class,'register']);
Route::get('login',[AuthController::class,'login_form'])->name('login');
Route::post('login',[AuthController::class,'login']);
Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[HomeController::class,'dashboard'])->name('dashboard');

    //Resource Route
    Route::resource('customer',CustomerController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('item',ItemController::class);
    Route::resource('unit',UnitController::class);
    Route::resource('party',PartyController::class);

    //Purchase Route
    Route::get('purchaseEntry',[PurchaseController::class,'purchaseEntry'])->name('purchaseEntry');
    Route::get('storePurchaseLowerEntry',[PurchaseController::class,'storePurchaseLowerEntry'])->name('storePurchaseLowerEntry');
    Route::get('purchase',[PurchaseController::class,'index'])->name('purchase.index');
});
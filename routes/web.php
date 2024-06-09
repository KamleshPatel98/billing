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
use App\Http\Controllers\SaleEntryController;
use App\Http\Controllers\SaleItemEntryController;
use App\Http\Controllers\InvoiceController;

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
  
    Route::resource('saleEntry',SaleEntryController::class);
    Route::get('addSaleEntry',[SaleEntryController::class,'addSaleEntry'])->name('addSaleEntry');
    Route::get('updateSaleEntry',[SaleEntryController::class,'updateSaleEntry'])->name('updateSaleEntry');
    Route::get('editSaleEntry/{id}',[SaleEntryController::class,'editSaleEntry'])->name('editSaleEntry');
    Route::delete('deleteSaleEntry/{id}',[SaleEntryController::class,'destroy'])->name('deleteSaleEntry');
    Route::get('saleEntryDetails',[SaleEntryController::class,'saleEntryDetails'])->name('saleEntry.saleEntryDetails');
    Route::resource('saleItemEntry',SaleItemEntryController::class);
    Route::get('storeSaleLowerEntry',[SaleItemEntryController::class,'storeSaleLowerEntry'])->name('storeSaleLowerEntry');
    Route::get('editItem',[SaleItemEntryController::class,'editItem'])->name('saleItemEntry.editItem');
    Route::get('updateItem',[SaleItemEntryController::class,'updateItem'])->name('saleItemEntry.updateItem');
    Route::get('deleteItem',[SaleItemEntryController::class,'deleteItem'])->name('saleItemEntry.deleteItem');
    
    //Invoice
    Route::get('sale_invoice/{sale_id}',[InvoiceController::class,'sale_invoice'])->name('invoice.sale_invoice');
});
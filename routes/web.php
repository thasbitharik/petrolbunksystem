<?php

use App\Http\Controllers\ProductPurchaseController;
use App\Http\Controllers\ProductUnitPriceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutTypeController;
use App\Http\Controllers\PumpController;
use App\Http\Controllers\PumpProductTypeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// Product Type
Route::group(['middleware'=>['auth']],function(){
Route::get('product_type', [ProdutTypeController::class, 'index'])->name('product_type.index');
Route::post('product_type/store', [ProdutTypeController::class, 'store'])->name('product_type.store');
Route::get('product_type/edit/{id}', [ProdutTypeController::class, 'edit'])->name('product_type.edit');
Route::put('product_type/update/{id}', [ProdutTypeController::class, 'update'])->name('product_type.update');
Route::post('product_type/delete', [ProdutTypeController::class, 'delete'])->name('product_type.delete');

// Pump
Route::get('pump', [PumpController::class, 'index'])->name('pump.index');
Route::post('pump/store', [PumpController::class, 'store'])->name('pump.store');
Route::get('pump/edit/{id}', [PumpController::class, 'edit'])->name('pump.edit');
Route::put('pump/update/{id}', [PumpController::class, 'update'])->name('pump.update');
Route::post('pump/delete', [PumpController::class, 'delete'])->name('pump.delete');


// PumpProduct
Route::get('pump_product', [PumpProductTypeController::class, 'index'])->name('pump_product.index');
Route::post('pump_product/store', [PumpProductTypeController::class, 'store'])->name('pump_product.store');
Route::get('pump_product/edit/{id}', [PumpProductTypeController::class, 'edit'])->name('pump_product.edit');
Route::put('pump_product/update/{id}', [PumpProductTypeController::class, 'update'])->name('pump_product.update');
Route::post('pump_product/delete', [PumpProductTypeController::class, 'delete'])->name('pump_product.delete');

// ProductPurchase
Route::get('product_purchase', [ProductPurchaseController::class, 'index'])->name('product_purchase.index');
Route::post('product_purchase/store', [ProductPurchaseController::class, 'store'])->name('product_purchase.store');
Route::get('product_purchase/edit/{id}', [ProductPurchaseController::class, 'edit'])->name('product_purchase.edit');
Route::put('product_purchase/update/{id}', [ProductPurchaseController::class, 'update'])->name('product_purchase.update');
Route::post('product_purchase/delete', [ProductPurchaseController::class, 'delete'])->name('product_purchase.delete');


// ProductPerUnit
Route::get('unit_price', [ProductUnitPriceController::class, 'index'])->name('unit_price.index');
Route::post('unit_price/store', [ProductUnitPriceController::class, 'store'])->name('unit_price.store');
Route::get('unit_price/edit/{id}', [ProductUnitPriceController::class, 'edit'])->name('unit_price.edit');
Route::put('unit_price/update/{id}', [ProductUnitPriceController::class, 'update'])->name('unit_price.update');
Route::post('unit_price/delete', [ProductUnitPriceController::class, 'delete'])->name('unit_price.delete');




// Sales
Route::get('sales', [SalesController::class, 'index'])->name('sales.index');
Route::post('sales/store', [SalesController::class, 'store'])->name('sales.store');
Route::get('sales/edit/{id}', [SalesController::class, 'edit'])->name('sales.edit');
Route::put('sales/update/{id}', [SalesController::class, 'update'])->name('sales.update');
Route::post('sales/delete', [SalesController::class, 'delete'])->name('sales.delete');
Route::get('/get-product-details', [SalesController::class, 'getProductDetails'])->name('get.product.details');

Route::get('/getProductByPump/{pumpId}', [SalesController::class, 'getProductByPump']);
Route::get('target-route', [SalesController::class, 'targetMethod'])->name('target.route');



});

<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(App\Http\Controllers\Customer\HomeController::class)->prefix('customer')->group(function(){
    Route::get('/home', 'index')->name('customer.home');
    Route::post('/addToCart', 'addToCart')->name('customer.addToCart');
});

Route::controller(App\Http\Controllers\Customer\CartsController::class)->prefix('customer')->group(function(){
    Route::get('/carts', 'index')->name('customer.carts');
    Route::delete('/carts/{id}', 'destroy')->name('customer.deletecart');
    Route::put('/carts/{id}', 'update')->name('customer.updatecart');
});

Route::get('cashier/home', function(){})->name('cashier.home');
Route::get('manager/home', function(){})->name('manager.home');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GatewayController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('register-data-customer', [RegisterController::class, 'register'])->name('customers.register');
Route::post('register-data-customer', [RegisterController::class, 'storeData'])->name('customers.store.data');

Route::get('order-resume/{code}', [OrderController::class, 'resume'])->name('orders.resume');
Route::post('checkout-request/{code}', [GatewayController::class, 'checkoutRequest'])->name('checkout.request');
Route::get('checkout-response', [GatewayController::class, 'checkoutResponse'])->name('checkout.response');

Route::get('admin/orders', [OrderController::class, 'adminListOrders'])->name('admin.orders.list');
Route::get('orders', [OrderController::class, 'listOrders'])->name('orders.list')->middleware('auth');

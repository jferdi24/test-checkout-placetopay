<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('register-data-customer', [RegisterController::class, 'register'])->name('customers.register');
Route::post('register-data-customer', [RegisterController::class, 'storeData'])->name('customers.store.data');
Route::get('checkout-response', [GatewayController::class, 'checkoutResponse'])->name('checkout.response');
Route::get('admin/orders', [OrderController::class, 'adminListOrders'])->name('admin.orders.list');

Route::middleware('auth')->group(function () {
    Route::get('order-resume/{code}', [OrderController::class, 'resume'])->name('orders.resume');
    Route::post('checkout-request/{code}', [GatewayController::class, 'checkoutRequest'])->name('checkout.request');
    Route::get('orders', [OrderController::class, 'listOrders'])->name('orders.list');
});

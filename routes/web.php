<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GatewayController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('register-data-customer', [RegisterController::class, 'register'])->name('customers.register');
Route::post('register-data-customer', [RegisterController::class, 'storeData'])->name('customers.store.data');

Route::get('order-resume/{code}', [OrderController::class, 'resume'])->name('orders.resume')
    ->middleware('auth');

Route::post('checkout-request/{code}', [GatewayController::class, 'checkoutRequest'])
    ->name('checkout.request')->middleware('auth');
Route::get('checkout-response', [GatewayController::class, 'checkoutResponse'])->name('checkout.response');

Route::get('admin/orders', [OrderController::class, 'adminListOrders'])->name('admin.orders.list');

Route::get('orders', [OrderController::class, 'listOrders'])->name('orders.list')
    ->middleware('auth');

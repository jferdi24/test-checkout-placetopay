<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;

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

Route::get('order-resume', [OrderController::class, 'resume'])->name('orders.resume');

//Route::get('orders', []);
//Route::get('orders/resume', []);
//Route::get('admin/orders', []);

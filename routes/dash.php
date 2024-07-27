<?php

use App\Http\Controllers\Dash\AdminController;
use App\Http\Controllers\Dash\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dash\CategoryController;
use App\Http\Controllers\Dash\AuthController;
use App\Http\Controllers\Dash\DashController;
use App\Http\Controllers\Dash\ProductController;

Route::middleware('guest:admin')->group(function () {
    Route::view('login', 'dash.auth.login')->name('loginForm');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth-admin'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', DashController::class)->name('index');

    Route::resource("products", ProductController::class)->except('show');
    Route::get('products/{product}/activities', [ProductController::class, 'getActivities'])->name('products.activities');
    Route::resource('categories', CategoryController::class)->except('show');

    Route::resource('roles', RoleController::class);
    Route::resource('admins', AdminController::class);

    Route::get('test/notification', function () {
        $product = \App\Models\Product::inRandomOrder()->first();

        broadcast(new \App\Events\ProductStockChanged($product));

        $message = $product->current_stock < 5 ? "<p style='color: green'>Notification has been sent </p>" : "<p style='color: red'>Notification has not been sent because the stock is not less than 5 </p>";

        return "<h1>Product: {$product->name} ( {$product->current_stock} ) </h1> <br>{$message} <br> Refresh the page to try again <br> Make sure that you open any page at main dashboard to see notification";
    })->name('test.notification');
});



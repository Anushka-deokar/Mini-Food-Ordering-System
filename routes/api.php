<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\RoleMiddleware;

// Public Auth API
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

// Authenticated User API
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::get('/me', [AuthController::class, 'me'])->name('api.me');

    // Admin Routes
    Route::prefix('admin')->middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'summary'])->name('api.admin.dashboard');
        Route::apiResource('/foods', FoodController::class);
        Route::get('/foods/trash', [FoodController::class, 'trash'])->name('api.admin.foods.trash');
    });

    // User Routes
    Route::prefix('user')->middleware([RoleMiddleware::class . ':user'])->group(function () {
        Route::get('/orders', [OrderController::class, 'userIndex'])->name('api.user.orders.index');
        Route::post('/orders', [OrderController::class, 'store'])->name('api.user.orders.store');
    });
});
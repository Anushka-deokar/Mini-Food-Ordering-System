<?php

use App\Http\Controllers\Admin\FoodController as AdminFoodController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\OrderController as UserOrderController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Menu Route - Only for non-admin users
    Route::middleware('role:user')->group(function () {
        Route::get('/menu', [FoodController::class, 'userIndex'])->name('foods.index');
        Route::get('/menu/{food}', [FoodController::class, 'show'])->name('foods.show');
    });
    Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    });

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('foods/trash', [AdminFoodController::class, 'trash'])->name('admin.foods.trash');
        Route::delete('foods/{food}/force-delete', [AdminFoodController::class, 'forceDestroy'])->name('admin.foods.force-delete');
        Route::post('foods/{food}/restore', [AdminFoodController::class, 'restore'])->name('admin.foods.restore');
        Route::get('/admin/orders/export', [OrderController::class, 'exportCsv'])->name('admin.orders.export');


        //To view orders for admi
        Route::get('/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
        Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');


        Route::resource('foods', AdminFoodController::class)->except(['show'])->names([
            'index' => 'admin.foods.index',
            'create' => 'admin.foods.create',
            'store' => 'admin.foods.store',
            'edit' => 'admin.foods.edit',
            'update' => 'admin.foods.update',
            'destroy' => 'admin.foods.destroy'
        ]);
    });
});
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
});



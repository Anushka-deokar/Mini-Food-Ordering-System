<?php

namespace App\Providers;
use App\Models\Food;
use App\Observers\FoodObserver;
use App\Observers\UserObserver;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\EloquentUserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\FoodService;
use App\Models\Order;
use App\Observers\OrderObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(FoodService::class, function ($app) {
            return new FoodService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Food::observe(FoodObserver::class);
        User::observe(UserObserver::class);
        Order::observe(OrderObserver::class);
        Food::observe(FoodObserver::class);
    }
}

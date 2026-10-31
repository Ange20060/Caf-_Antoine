<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Payment;
use App\Policies\MenuItemPolicy;
use App\Policies\OrderPolicy;
use App\Policies\PaymentPolicy;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         Gate::policy(MenuItem::class, MenuItemPolicy::class);
         Gate::policy(Order::class, OrderPolicy::class);
         Gate::policy(Payment::class, PaymentPolicy::class);
    }
}

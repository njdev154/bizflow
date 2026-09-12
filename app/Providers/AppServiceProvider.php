<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
{
    Schema::defaultStringLength(191);
    \Carbon\Carbon::setLocale(config('app.locale'));
}
}

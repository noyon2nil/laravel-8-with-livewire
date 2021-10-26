<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::macro('toDateFormat', function () {
            return $this->format('d-m-Y');
        });

        Carbon::macro('toTimeFormat', function () {
            return $this->format('h:i A');
        });

        Carbon::macro('toDateTimeFormat', function () {
            return $this->format('d M Y h:i A');
        });
    }
}

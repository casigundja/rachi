<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        if (php_sapi_name() === 'cli') {
            @set_time_limit(0);
            @ini_set('max_execution_time', '0');
        } else {
            @ini_set('max_execution_time', '120');
        }

        if (config('database.default') === 'sqlite') {
            try {
                \Illuminate\Support\Facades\DB::statement('PRAGMA journal_mode=WAL;');
                \Illuminate\Support\Facades\DB::statement('PRAGMA synchronous=NORMAL;');
                \Illuminate\Support\Facades\DB::statement('PRAGMA busy_timeout=5000;');
            } catch (\Throwable $e) {}
        }
    }
}

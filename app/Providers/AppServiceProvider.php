<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use App\Observers\CategoryObserver;
use App\Observers\LeadObserver;
use App\Observers\ProductObserver;
use App\Observers\SubcategoryObserver;
use App\Observers\SubsubcategoryObserver;
use App\Services\SitemapService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        // Paginator::defaultView('view-name');

        // Paginator::defaultSimpleView('view-name');
        Paginator::useBootstrapFive();
        // Customer::observe(LeadObserver::class);
        // DB::listen(function ($query) {

        //     if ($query->time > 500) { // 500ms slow query
        //         Log::channel('debuglog')->warning('SLOW QUERY', [
        //             'sql' => $query->sql,
        //             'time_ms' => $query->time,
        //             'bindings' => $query->bindings
        //         ]);
        //     }
        // });
        Log::channel('projectlog')->info('REQUEST_START', [
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'ip' => request()->ip(),
            'memory_mb' => round(memory_get_usage(true) / 1024 / 1024, 2),
            'time' => now()->toDateTimeString(),
        ]);
        /*
    |--------------------------------------------------------------------------
    | 2. SLOW QUERY LOGGER
    |--------------------------------------------------------------------------
    */

        DB::listen(function ($query) {

            if ($query->time > 300) {
                app()->terminating(function () use ($query) {
                    Log::channel('projectlog')->warning('SLOW_QUERY', [
                        'sql' => $query->sql,
                        'time_ms' => $query->time,
                    ]);
                });
            }
        });



        /*
    |--------------------------------------------------------------------------
    | 3. UNCAUGHT EXCEPTION LOGGER
    |--------------------------------------------------------------------------
    */


        /*
    |--------------------------------------------------------------------------
    | FATAL / MEMORY / TIMEOUT LOGGER
    |--------------------------------------------------------------------------
    */
        // register_shutdown_function(function () {

        //     $error = error_get_last();

        //     if ($error !== null) {

        //         Log::channel('projectlog')->critical('FATAL_ERROR', [
        //             'type' => $error['type'],
        //             'message' => $error['message'],
        //             'file' => $error['file'],
        //             'line' => $error['line'],
        //         ]);
        //     }

        //     Log::channel('projectlog')->info('REQUEST_END', [
        //         'memory_peak_mb' => round(memory_get_peak_usage(true) / 1024 / 1024, 2),
        //     ]);
        // });

        // register_shutdown_function(function () {
        //     $error = error_get_last();

        //     if ($error && in_array($error['type'], [
        //         E_ERROR,
        //         E_CORE_ERROR,
        //         E_COMPILE_ERROR,
        //         E_PARSE,
        //     ])) {
        //         Log::channel('projectlog')->critical('FATAL_ERROR', [
        //             'message' => $error['message'],
        //             'file' => $error['file'],
        //             'line' => $error['line'],
        //         ]);
        //     }
        // });
        register_shutdown_function(function () {
            $error = error_get_last();
            if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR])) {
                Log::channel('projectlog')->critical('FATAL_ERROR', $error);
            }
        });



        // Paginator::useBootstrapFour();

    }
}
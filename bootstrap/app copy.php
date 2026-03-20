<?php

use App\Http\Middleware\VerifyRecaptcha;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    // ->withMiddleware(function (Middleware $middleware) {
    // $middleware->append(VerifyRecaptcha::class);
    // $middleware->append(RequestDebugLogger::class);
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->use([
        //     \App\Http\Middleware\RequestDebugLogger::class,
        // ]);
    })

    // })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (\Throwable $e) {

            Log::channel('projectlog')->error('CRASH', [
                'url' => request()->fullUrl(),
                'method' => request()->method(),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        });
        //
    })->create();
<?php

use BezhanSalleh\FilamentExceptions\FilamentExceptions;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        // health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\Spatie\HttpLogger\Middlewares\HttpLogger::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        $exceptions->report(function (Throwable $e) {
            FilamentExceptions::report($e);
        });
        // $exceptions->reportable(function (Throwable $e) {
        //     if ($this->shouldReport($e)) {
        //         FilamentExceptions::report($e);
        //     }
        // });
    })->create();

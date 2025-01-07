<?php

declare(strict_types=1);

use App\Http\Middleware\UnescapeJsonResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        apiPrefix: '',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(static function (Middleware $middleware) {
        $middleware->append([
            UnescapeJsonResponse::class,
        ]);
    })
    ->withExceptions(static function (Exceptions $exceptions) {})->create()
;

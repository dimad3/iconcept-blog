<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->web([
        //     // other middleware...
        //     'post-author' => \App\Http\Middleware\PostAuthorMiddleware::class,
        // ]);

        // $middleware->api([
        //     // API middleware...
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

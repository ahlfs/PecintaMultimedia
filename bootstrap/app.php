<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'manual.auth' => \App\Http\Middleware\ManualAuth::class,
            'manual.guest' => \App\Http\Middleware\ManualGuest::class,
            'ShareAuthUser' => \App\Http\Middleware\ShareAuthUser::class,
        ]);

        $middleware->appendToGroup('web', \App\Http\Middleware\ShareAuthUser::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

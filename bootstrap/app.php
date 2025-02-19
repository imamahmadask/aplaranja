<?php

use App\Http\Middleware\CekRole;
use App\Http\Middleware\FrameGuard;
use App\Http\Middleware\HSTS;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'cekRole' => CekRole::class,
        ]);
        $middleware->append(FrameGuard::class);
        $middleware->append(HSTS::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

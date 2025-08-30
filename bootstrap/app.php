<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web.php',
            __DIR__ . '/../routes/admin.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'authGuard' => \App\Http\Middleware\AuthGuard::class,
            'updateLastSeen' => \App\Http\Middleware\UpdateLastSeen::class,
            'isCmsInstalled' => \App\Http\Middleware\IsCmsInstalled::class,
            'accessAdmin' => \App\Http\Middleware\AccessAdmin::class,
            'accessDeveloper' => \App\Http\Middleware\AccessDeveloper::class,
            'accessDeveloper' => \App\Http\Middleware\AccessDeveloper::class,
            'injectContentType' => \App\Http\Middleware\InjectContentType::class,
            
            // TODO Check how to differientiate between admin and frontend
            'setLocale' => \App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

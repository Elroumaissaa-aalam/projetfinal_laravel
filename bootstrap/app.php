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
    ->withMiddleware(function (Middleware $middleware) {
        // Register middleware alias
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
        
        // Ensure cache directories exist
        $cachePaths = [
            storage_path('framework/cache'),
            storage_path('framework/views'),
            storage_path('framework/sessions'),
        ];
        
        foreach ($cachePaths as $path) {
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
        }
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();



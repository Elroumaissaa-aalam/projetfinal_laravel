<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('blade.compiler', function ($app) {
            $cachePath = $app['config']['view.compiled'] ?: storage_path('framework/views');
            
            // Ensure cache path exists
            if (!is_dir($cachePath)) {
                mkdir($cachePath, 0755, true);
            }
            
            return new BladeCompiler(
                $app['files'],
                $cachePath,
                $app->basePath()
            );
        });
    }
}
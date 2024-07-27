<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__ . '/../routes/console.php',
        using: function () {
            Route::middleware('web')
                ->name('dash.')
                ->prefix('dash')
                ->group(base_path('routes/dash.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->append(SetLocale::class);

        $middleware->alias([
            'auth-admin' => \App\Http\Middleware\RedirectIfNotAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();


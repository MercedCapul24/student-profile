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
        $middleware->redirectGuestsTo('/login');     // not logged in -> go to login
        $middleware->redirectUsersTo('/students');   // already logged in -> skip login page

        $middleware->alias([
            'nocache' => \App\Http\Middleware\NoCache::class,
            'once'    => \App\Http\Middleware\PreventDuplicateSubmit::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
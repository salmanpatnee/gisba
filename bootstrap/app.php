<?php

use App\Http\Middleware\EnsureMemberAccess;
use App\Http\Middleware\LowercaseUrl;
use App\Http\Middleware\RedirectIfMember;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->prepend(LowercaseUrl::class);
        $middleware->alias([
            'member'             => EnsureMemberAccess::class,
            'redirect-if-member' => RedirectIfMember::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

return $app;

<?php

use App\Http\Middleware\CheckInactivity;
use App\Http\Middleware\ConfigureSessionTimeout;
use App\Http\Middleware\EnsureAdminIsApproved;
use App\Http\Middleware\EnsureResidentIsVerified;
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
        $middleware->web(
            prepend: [
                ConfigureSessionTimeout::class,
            ],
            append: [
                CheckInactivity::class,
            ],
        );

        $middleware->alias([
            'role' => EnsureUserHasRole::class,
            'verified.resident' => EnsureResidentIsVerified::class,
            'approved.admin' => EnsureAdminIsApproved::class,
            'inactivity' => CheckInactivity::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();

<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // ── Security Headers ──────────────────────────────────────────
        $middleware->web(append: [
            function (Request $request, \Closure $next) {
                /** @var Response $response */
                $response = $next($request);

                // Prevent clickjacking
                $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
                // Prevent MIME sniffing
                $response->headers->set('X-Content-Type-Options', 'nosniff');
                // XSS protection (legacy)
                $response->headers->set('X-XSS-Protection', '1; mode=block');
                // Referrer policy
                $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
                // Permissions policy
                $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
                // Remove server fingerprint
                $response->headers->remove('X-Powered-By');
                $response->headers->remove('Server');

                return $response;
            },
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

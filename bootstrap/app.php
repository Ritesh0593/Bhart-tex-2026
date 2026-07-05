<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Define custom temporary directory to avoid tempnam() warnings on shared hosting
$tempDir = __DIR__ . '/../storage/app/temp';
if (!file_exists($tempDir)) {
    @mkdir($tempDir, 0777, true);
}
@mkdir(__DIR__ . '/../storage/framework/views', 0777, true);
@mkdir(__DIR__ . '/../storage/framework/cache', 0777, true);
@mkdir(__DIR__ . '/../storage/framework/sessions', 0777, true);

putenv('TMPDIR=' . $tempDir);
putenv('TEMP=' . $tempDir);
putenv('TMP=' . $tempDir);

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

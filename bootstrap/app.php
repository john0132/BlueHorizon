<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Register a lightweight PSR-4 autoloader for the Modules namespace to avoid relying on composer dump
// This ensures classes like Modules\Authentication\Providers\AuthenticationServiceProvider are found at runtime
$__basePath = dirname(__DIR__);
spl_autoload_register(static function (string $class) use ($__basePath): void {
    if (strncmp($class, 'Modules\\', 8) !== 0) {
        return;
    }

    // Expecting classes like: Modules\\{Module}\\... which live under Modules/{Module}/app/...
    $withoutRoot = substr($class, 8); // strip 'Modules\\'
    $parts = explode('\\', $withoutRoot, 2);
    $module = $parts[0] ?? '';
    $remainder = $parts[1] ?? '';
    if ($module === '' || $remainder === '') {
        return;
    }

    $relativePath = 'Modules/'.$module.'/app/'.str_replace('\\', '/', $remainder).'.php';
    $file = $__basePath.'/'.$relativePath;

    if (is_file($file)) {
        require $file;
    }
});

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

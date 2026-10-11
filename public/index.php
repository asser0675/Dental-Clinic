<?php

// Buffer early output so a warning or exception cannot commit HTTP headers
// before Laravel/Symfony has had an opportunity to send the response.
// Keep the buffer active through exception and shutdown handling.
if (PHP_SAPI === 'cli-server' && ob_get_level() === 0) {
    ob_start();
}

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());

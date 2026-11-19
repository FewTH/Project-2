<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Reverse proxy mounts this app at /random_reward and forwards
// /random_reward/login as //login. Collapse duplicate slashes so routes match.
if (isset($_SERVER['REQUEST_URI'])) {
    $requestUri = $_SERVER['REQUEST_URI'];
    $query = '';
    if (($queryPos = strpos($requestUri, '?')) !== false) {
        $query = substr($requestUri, $queryPos);
        $requestUri = substr($requestUri, 0, $queryPos);
    }
    $requestUri = preg_replace('#/{2,}#', '/', $requestUri) ?: '/';
    $_SERVER['REQUEST_URI'] = $requestUri.$query;
}

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

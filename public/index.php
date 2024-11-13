<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Nekolympus\Project\core\Route;

use Dotenv\Dotenv;

use Nekolympus\Project\middleware\AuthMiddleware;
use Nekolympus\Project\core\Middleware;
use Nekolympus\Project\middleware\AdminMiddleware;
use Nekolympus\Project\middleware\GuestMiddleware;

Middleware::register('admin', AdminMiddleware::class);
Middleware::register('auth', AuthMiddleware::class);
Middleware::register('guest', GuestMiddleware::class);

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once __DIR__ . '/../routes/web.php';
require_once '../routes/api.php'; 
Route::handleRequest($requestUrl, $requestMethod);

<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Nekolympus\Project\core\Route;

use Dotenv\Dotenv;

use Nekolympus\Project\middleware\AuthMiddleware;
use Nekolympus\Project\core\Middleware;
use Nekolympus\Project\middleware\AdminMiddleware;
use Nekolympus\Project\middleware\ApiMiddleware;
use Nekolympus\Project\middleware\GuestMiddleware;
use Nekolympus\Project\middleware\GuruMiddleware;

Middleware::register('admin', AdminMiddleware::class);
Middleware::register('auth', AuthMiddleware::class);
Middleware::register('guest', GuestMiddleware::class);
<<<<<<< HEAD
Middleware::register('bearer', ApiMiddleware::class);
=======
Middleware::register('guru', GuruMiddleware::class);
>>>>>>> 4f9fef28d4c3b4f5d50ceca475d4dc292dc9825e

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once __DIR__ . '/../routes/web.php';
require_once '../routes/api.php'; 
Route::handleRequest($requestUrl, $requestMethod);

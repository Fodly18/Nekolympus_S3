<?php

use Nekolympus\Project\controllers\Web\AuthController;
use Nekolympus\Project\controllers\Web\DashboardController;
use Nekolympus\Project\core\Route;
use Nekolympus\Project\controllers\Web\HomeController;

Route::get('/', HomeController::class, 'index')->middleware(['guest']);
Route::get('/sejarah', HomeController::class, 'sejarah')->middleware(['guest']);
Route::get('/visi-misi', HomeController::class, 'Visi_misi')->middleware(['guest']);


Route::get('/login-admin', AuthController::class, 'indexAdmin')->middleware(['guest']);
Route::post('/login-admin', AuthController::class, 'LoginAdmin')->middleware(['guest']);

Route::get('/dashboard-admin', DashboardController::class, 'index')->middleware(['auth', 'admin']);

// Route::post('/login', AuthController::class, 'login');

// Route::get('/home', HomeController::class, 'index')->middleware(['auth']);

// Route::get('/test', HomeController::class, 'test');

// Route::get('/test/{id}', HomeController::class, 'get');
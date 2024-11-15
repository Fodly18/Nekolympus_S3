<?php

use Nekolympus\Project\controllers\Web\AuthController;
use Nekolympus\Project\controllers\Web\DashboardController;
use Nekolympus\Project\core\Route;
use Nekolympus\Project\controllers\Web\HomeController;
use Nekolympus\Project\controllers\Web\MapelController;

Route::get('/', HomeController::class, 'index')->middleware(['guest']);

Route::get('/login-admin', AuthController::class, 'indexAdmin')->middleware(['guest']);
Route::post('/login-admin', AuthController::class, 'LoginAdmin')->middleware(['guest']);

Route::get('/dashboard-admin', DashboardController::class, 'index')->middleware(['auth', 'admin']);

Route::get('/mapel', MapelController::class, 'index');
Route::get('/create', MapelController::class, 'createIndex');
Route::post('/create', MapelController::class, 'create');
Route::get('/update/{id}', MapelController::class, 'updateIndex');
Route::post('/update', MapelController::class, 'update');
Route::get('/delete/{id}', MapelController::class, 'delete');  
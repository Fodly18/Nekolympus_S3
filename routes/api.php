<?php

use Nekolympus\Project\controllers\Api\AuthController;
use Nekolympus\Project\core\Route;

Route::prefix('/api');

Route::post('/login', AuthController::class, 'Login');

Route::post('/logout', AuthController::class, 'Logout');

Route::get('/profile', AuthController::class, 'profile');

// Route::post('/data', TestApiController::class, 'data');

<?php

use Nekolympus\Project\controllers\Api\AuthController;
use Nekolympus\Project\controllers\Api\HomeController;
use Nekolympus\Project\controllers\Api\TugasController;
use Nekolympus\Project\core\Route;

Route::prefix('/api');

Route::post('/login', AuthController::class, 'Login');

Route::post('/logout', AuthController::class, 'Logout');

Route::get('/profile', AuthController::class, 'profile');

Route::get('/jadwal', HomeController::class, 'getJadwal');

Route::get('/wali', HomeController::class, 'getWaliKelas');

Route::get('/mapel-kelas', TugasController::class, 'getMapelKelas');

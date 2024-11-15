<?php

use Nekolympus\Project\controllers\Web\AuthController;
use Nekolympus\Project\controllers\Web\DashboardController;
use Nekolympus\Project\core\Route;
use Nekolympus\Project\controllers\Web\HomeController;
use Nekolympus\Project\controllers\Web\MapelController;

Route::get('/', HomeController::class, 'index')->middleware(['guest']);
Route::get('/sejarah', HomeController::class, 'sejarah')->middleware(['guest']);
Route::get('/Visi-misi', HomeController::class, 'Visi_misi')->middleware(['guest']);
Route::get('/acara_sekolah', HomeController::class, 'acara_sekolah')->middleware(['guest']);
Route::get('/prestasi', HomeController::class, 'prestasi')->middleware(['guest']);
Route::get('/berita', HomeController::class, 'berita')->middleware(['guest']);
Route::get('/ppdb', HomeController::class, 'ppdb')->middleware(['guest']);
Route::get('/kontak', HomeController::class, 'kontak')->middleware(['guest']);
Route::get('/strukture-organisasi', HomeController::class, 'strukture_organisasi')->middleware(['guest']);


Route::get('/login-admin', AuthController::class, 'indexAdmin')->middleware(['guest']);
Route::post('/login-admin', AuthController::class, 'LoginAdmin')->middleware(['guest']);

Route::get('/dashboard-admin', DashboardController::class, 'index')->middleware(['auth', 'admin']);


Route::get('/mapel', MapelController::class, 'index');
Route::get('/create', MapelController::class, 'createIndex');
Route::post('/create', MapelController::class, 'create');
Route::get('/update/{id}', MapelController::class, 'updateIndex');
Route::post('/update', MapelController::class, 'update');
Route::get('/delete/{id}', MapelController::class, 'delete');  

// Route::post('/login', AuthController::class, 'login');

// Route::get('/home', HomeController::class, 'index')->middleware(['auth']);

// Route::get('/test', HomeController::class, 'test');

// Route::get('/test/{id}', HomeController::class, 'get');

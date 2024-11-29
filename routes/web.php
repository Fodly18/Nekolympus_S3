<?php

use Nekolympus\Project\controllers\Web\AuthController;
use Nekolympus\Project\controllers\Web\DashboardController;
use Nekolympus\Project\core\Route;
use Nekolympus\Project\controllers\Web\HomeController;
use Nekolympus\Project\controllers\Web\MapelController;
use Nekolympus\Project\controllers\Web\GuruController;

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

Route::get('/login-guru', AuthController::class, 'indexGuru')->middleware(['guest']);
Route::post('/login-guru', AuthController::class, 'LoginGuru')->middleware(['guest']);

Route::get('/dashboard-admin', DashboardController::class, 'indexAdmin')->middleware(['auth', 'admin']);
Route::get('/logout-admin', AuthController::class, 'logoutAdmin')->middleware(['auth', 'admin']);
// Route Dashboard Guru
Route::get('/dashboard-guru', DashboardController::class, 'indexGuru')->middleware(['auth', 'guru']);
Route::get('/daftar-siswa', DashboardController::class, 'dafsisGuru')->middleware(['auth', 'guru']);
Route::get('/tugas-pembelajaran', DashboardController::class, 'tugasGuru')->middleware(['auth', 'guru']);
Route::get('/latihan-soal', DashboardController::class, 'latsolGuru')->middleware(['auth', 'guru']);
Route::get('/settings', DashboardController::class, 'settingGuru')->middleware(['auth', 'guru']);
Route::get('/logout-guru', AuthController::class, 'logoutGuru')->middleware(['auth', 'guru']);

// Routing untuk Guru
Route::get('/guru', GuruController::class, 'index')->middleware(['auth', 'admin']);
Route::get('/guru/create', GuruController::class, 'createIndex')->middleware(['auth', 'admin']);
Route::post('/guru/create', GuruController::class, 'create')->middleware(['auth', 'admin']);
Route::get('/guru/update/{id}', GuruController::class, 'updateIndex')->middleware(['auth', 'admin']);
Route::post('/guru/update', GuruController::class, 'update')->middleware(['auth', 'admin']);
Route::get('/guru/delete/{id}', GuruController::class, 'delete')->middleware(['auth', 'admin']); // Changed back to GET

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
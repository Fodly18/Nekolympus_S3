<?php

use Nekolympus\Project\controllers\Api\AuthController;
use Nekolympus\Project\controllers\Api\HomeController;
use Nekolympus\Project\controllers\Api\TugasController;
use Nekolympus\Project\core\Route;

Route::prefix('/api');

Route::post('/login', AuthController::class, 'Login');

Route::post('/logout', AuthController::class, 'Logout')->middleware(['bearer']);

Route::post('/update-password', AuthController::class, 'updatePassword')->middleware(['bearer']);

Route::get('/profile', AuthController::class, 'profile')->middleware(['bearer']);;

Route::get('/jadwal', HomeController::class, 'getJadwal')->middleware(['bearer']);;

Route::get('/wali', HomeController::class, 'getWaliKelas')->middleware(['bearer']);;

Route::get('/mapel-kelas', TugasController::class, 'getMapelKelas')->middleware(['bearer']);

Route::get('/mapel-kelas/{id}/tugas', TugasController::class, 'getTugas')->middleware(['bearer']);

Route::get('/tugas/{id}', TugasController::class, 'getDetailTugas')->middleware(['bearer']);

Route::post('/submit-tugas', TugasController::class, 'SubmitTugas')->middleware(['bearer']);

Route::get('/tugas/{id}/nilai', TugasController::class, 'getNilaiTugas')->middleware(['bearer']);

Route::get('/latihan-soal/{id}', TugasController::class, 'getDetailLatihanSoal')->middleware(['bearer']);

Route::get('/mapel-kelas/{id}/latihan-soal', TugasController::class, 'getLatihanSoal')->middleware(['bearer']);

Route::get('/latihan-soal/{id}/process', TugasController::class, 'LatihanSoal')->middleware(['bearer']);

Route::post('/submit-latihan-soal', TugasController::class, 'SubmitLatihanSoal')->middleware(['bearer']);

Route::get('/latihan-soal/{id}/nilai', TugasController::class, 'getNilaiSoal')->middleware(['bearer']);

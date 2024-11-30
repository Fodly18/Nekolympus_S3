<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\models\LatihanSoal;

class DashboardController extends Controller
{
    public function indexAdmin()
    {
        return $this->view('admin.index');
    }

    //Ini Punya Guru
    public function indexGuru()
    {
        return $this->view('guru.index');
    }

    public function tugasGuru()
    {
        $idGuru = $_SESSION['auth'];
        $data = DB::table('tugas')
                ->join('mapel_kelas', 'tugas.id_mapel_kelas', '=', 'mapel_kelas.id')
                ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
                ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
                ->select(['tugas.id', 'mapel.nama', 'kelas.kelas', 'tugas.judul_tugas', 'tugas.deskripsi', 'tugas.tanggal_tugas', 'tugas.deadline'])
                ->where('mapel_kelas.id_guru', '=', $idGuru)
                ->get();
        $no = 1;
        return $this->view('guru.tugas.index', ['data' => $data, 'no' => $no]);
    }

    public function latsolGuru()
    {
        $data = LatihanSoal::all();
        $no = 1;
        return $this->view('guru.latihan-soal.index', ['data' => $data, 'no' => $no]);
    }

    public function dafsisGuru()
    {
        return $this->view('guru.daftar-siswa.index');
    }

    public function settingGuru()
    {
        return $this->view('guru.settings.index');
    }

    public function logoutGuru()
    {
        return $this->view('guru.logout');
    }
    
}
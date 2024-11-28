<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;

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
        return $this->view('guru.tugas.index');
    }

    public function latsolGuru()
    {
        return $this->view('guru.latihan-soal.index');
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
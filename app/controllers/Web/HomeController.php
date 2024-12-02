<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Helper;
use Nekolympus\Project\core\View;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Barang;

class HomeController extends Controller
{
    public function index()
    {
        return  $this->view('home.index');
    }


    public function sejarah()
    {
        return  $this->view('html.sejarah');
    }

    public function Visi_misi()
    {
    return $this->view('html.Visi-misi');
    
    }
    public function strukture_organisasi()
    {
    return $this->view('html.Struktur-Organisasi');
    
    }
    public function acara_sekolah()
    {
    return $this->view('html.Acara-Sekolah');
    
    }
    public function prestasi()
    {
    return $this->view('html.Prestasi');
    
    }
    public function berita()
    {
    return $this->view('html.Berita');
    
    }
    public function ppdb()
    {
    return $this->view('html.ppdb');
    
    }
    public function kontak()
    {
    return $this->view('html.kontak');
    
    }

    public function blog()
    {
    return $this->view('html.blog');
    
    }


}
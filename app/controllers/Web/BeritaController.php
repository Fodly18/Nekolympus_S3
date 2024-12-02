<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::all();
        return $this->view('admin.berita.index', ['data' => $data]);
    }

    public function createIndex()
    {
        return $this->view('admin.berita.create');
    }

    
}
<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Tugas;

class TugasController extends Controller
{
    public function index()
    {
        $idGuru = $_SESSION['auth'];
        $data = DB::table('tugas')
                ->join('mapel_kelas', 'tugas.id_mapel_kelas', '=', 'mapel_kelas.id')
                ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
                ->where('mapel_kelas.id_guru', '=', $idGuru)
                ->get();
        $no = 1;
        var_dump($data);
        return $this->view('guru.tugas.index', ['data' => $data, 'no' => $no]);
    }

    public function createIndex()
    {

    }

    public function create() 
    {

    }

    public function updateIndex() 
    {

    }

    public function update() 
    {

    }

    public function delete() 
    {
        
    }
}

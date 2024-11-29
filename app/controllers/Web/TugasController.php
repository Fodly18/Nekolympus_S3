<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\models\Kelas;
use Nekolympus\Project\models\Tugas;

class TugasController extends Controller
{
    public function index()
    {
        // $idGuru = $_SESSION['auth'];
        // $data = DB::table('tugas')
        //         ->join('mapel_kelas', 'tugas.id_mapel_kelas', '=', 'mapel_kelas.id')
        //         ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
                
        //         ->where('mapel_kelas.id_guru', '=', $idGuru)
        //         ->get();
        // $no = 1;
        // var_dump($data);
        // return $this->view('guru.tugas.index', ['data' => $data, 'no' => $no]);
    }

    public function createIndex()
    {
        $idGuru = $_SESSION['auth'];
        $data = DB::table('mapel_kelas')
                ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
                ->select(['kelas.id', 'kelas.kelas'])
                ->where('mapel_kelas.id_guru', '=', $idGuru)
                ->get();
        return $this->view('guru.tugas.create', ['data' => $data]);
    }

    public function create(Request $request) 
    {
        Tugas::create([
            'id_mapel_kelas' => $request->input('kelas'),
            'judul_tugas' => $request->input('judul_tugas'),
            'deskripsi' => $request->input('deskripsi'),
            'tanggal_tugas' => $request->input('tgl_tugas'),
            'deadline' => $request->input('tgl_deadline')
        ]);

        return $this->redirect('/tugas-pembelajaran');
    }

    public function updateIndex($id) 
    {
        $idGuru = $_SESSION['auth'];
        $kelas = DB::table('mapel_kelas')
                ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
                ->select(['kelas.id', 'kelas.kelas'])
                ->where('mapel_kelas.id_guru', '=', $idGuru)
                ->get();
        var_dump($id);
        $data = DB::table('tugas')
                ->join('mapel_kelas', 'tugas.id_mapel_kelas', '=', 'mapel_kelas.id')
                ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
                ->select(['tugas.id', 'mapel.nama', 'mapel_kelas.id_kelas as awok', 'tugas.judul_tugas', 'tugas.deskripsi', 'tugas.tanggal_tugas', 'tugas.deadline'])
                ->where('tugas.id', '=', $id)
                ->first();

        return $this->view('guru.tugas.update', ['data' => $data, 'asd' => $kelas]);
    }

    public function update(Request $request) 
    {
        Tugas::update($request->input('id'),[
            'id_mapel_kelas' => $request->input('kelas'),
            'judul_tugas' => $request->input('judul_tugas'),
            'deskripsi' => $request->input('deskripsi'),
            'tanggal_tugas' => $request->input('tgl_tugas'),
            'deadline' => $request->input('tgl_deadline')
        ]);

        return $this->redirect('/tugas-pembelajaran');
    }

    public function delete() 
    {
        
    }
}

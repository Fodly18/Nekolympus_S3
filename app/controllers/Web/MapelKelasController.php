<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\MapelKelas;

class MapelKelasController extends Controller
{
    public function index()
    {
        $data = DB::table('mapel_kelas')
            ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
            ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
            ->join('guru', 'mapel_kelas.id_guru', '=', 'guru.id')
            ->select([
                'mapel_kelas.id',
                'mapel.nama as nama',
                'kelas.kelas as kelas',
                'guru.nama as guru',
            ])
            ->get();
        return $this->view('admin.mapelkelas.index', ['data' => $data]);
    }

    public function createIndex()
    {

        $data = DB::table('mapel_kelas')
        ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
        ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
        ->join('guru', 'mapel_kelas.id_guru', '=', 'guru.id')
        ->select([
            'mapel_kelas.id',
            'mapel.nama as nama',
            'kelas.kelas as kelas',
            'guru.nama as guru',
        ])
        ->get();

        return $this->view('admin.mapelkelas.create',['data' => $data]);
    }

    public function create(Request $request)
    {
        $Mapelkelas = MapelKelas::create([
            'id_mapel' => $request->input('nama'),
            'id_kelas' => $request->input('kelas'),
            'id_guru' => $request->input('guru'),
        ]);
        

        return $this->redirect('/mapelkelas')->with('success', 'Data berhasil ditambahkan.');
    }

    public function updateIndex($id)
    {
        $data = DB::table('mapel_kelas')
        ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
        ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
        ->join('guru', 'mapel_kelas.id_guru', '=', 'guru.id')
        ->select([
            'mapel_kelas.id',
            'mapel.nama as nama',
            'kelas.kelas as kelas',
            'guru.nama as guru',
        ])
        ->get();
    }

    public function update(Request $request)
    {
        $Mapelkelas = MapelKelas::update($request->input('id'), [
            'id_mapel' => $request->input('nama_mapel'),
            'id_kelas' => $request->input('kelas'),
            'id_guru' => $request->input('guru'),
        ]);

        return $this->redirect('/mapelkelas')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        MapelKelas::delete($id);

        return $this->redirect('/mapelkelas')->with('success', 'Data berhasil dihapus.');
    }
}

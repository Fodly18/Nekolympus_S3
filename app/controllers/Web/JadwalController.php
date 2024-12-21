<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Jadwal;

class JadwalController extends Controller
{
    public function index()
    {
        $data = DB::table('jadwal')
            ->join('kelas', 'jadwal.id_kelas', '=', 'kelas.id')
            ->join('mapel', 'jadwal.id_mapel', '=', 'mapel.id')
            ->select([
                'jadwal.id',
                'kelas.kelas as kelas',
                'mapel.nama as mapel',
                'jadwal.hari',
                'jadwal.jam_mulai',
                'jadwal.jam_selesai',
            ])
            ->get();
        return $this->view('admin.jadwal.index', ['data' => $data]);
    }

    public function createIndex()
    {
        $data= DB::table('jadwal')
            ->join('kelas', 'jadwal.id_kelas', '=', 'kelas.id')
            ->join('mapel', 'jadwal.id_mapel', '=', 'mapel.id')
            ->select([
                'jadwal.id',
                'kelas.kelas as kelas',
                'mapel.nama as mapel',
                'jadwal.hari',
                'jadwal.jam_mulai',
                'jadwal.jam_selesai',
            ])
            ->get();
        // Ambil data kelas untuk dropdown
        $kelasData = DB::table('kelas')->select(['id', 'kelas'])->get();

        // Ambil data mata pelajaran untuk dropdown
        $mapelData = DB::table('mapel')->select(['id', 'nama'])->get();
    
        // Kirim semua data ke view
        return $this->view('admin.jadwal.create', [
            'data' => $data,
            'kelasData' => $kelasData,
            'mapelData' => $mapelData
        ]);
    }

    public function create(Request $request)
    {
        $Jadwal = Jadwal::create([
            'id_kelas' => $request->input('id_kelas'),
            'id_mapel' => $request->input('id_mapel'),
            'hari' => $request->input('hari'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
        ]);
        
        // Retrieve updated data after creation
        $data = DB::table('jadwal')
            ->join('kelas', 'jadwal.id_kelas', '=', 'kelas.id')
            ->join('mapel', 'jadwal.id_mapel', '=', 'mapel.id')
            ->select([
                'jadwal.id',
                'kelas.kelas as kelas',
                'mapel.nama as mapel',
                'jadwal.hari',
                'jadwal.jam_mulai',
                'jadwal.jam_selesai',
            ])
            ->get();
        
        return $this->view('admin.jadwal.index', ['data' => $data]);
    }

    public function updateIndex($id)
    {
        $data = DB::table('jadwal')
            ->join('kelas', 'jadwal.id_kelas', '=', 'kelas.id')
            ->join('mapel', 'jadwal.id_mapel', '=', 'mapel.id')
            ->select([
                'jadwal.id',
                'kelas.kelas as kelas',
                'mapel.nama as mapel',
                'jadwal.hari',
                'jadwal.jam_mulai',
                'jadwal.jam_selesai',
            ])
            ->get();
        return $this->view('admin.jadwal.index', ['data' => $data]);
    }

    public function update(Request $request)
    {
        $jadwal = Jadwal::update($request->input('id'), [
            'id_kelas' => $request->input('id_kelas'),
            'id_mapel' => $request->input('id_mapel'),
            'hari' => $request->input('hari'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
        ]);

        return $this->redirect('/jadwal');
    }

    public function delete($id)
    {
        Jadwal::delete($id);

        return $this->redirect('/jadwal');
    }
}

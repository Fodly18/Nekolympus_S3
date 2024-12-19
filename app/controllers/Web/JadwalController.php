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
                'kelas.kelas as nama_kelas',
                'mapel.nama as nama_mapel',
                'jadwal.hari',
                'jadwal.jam_mulai',
                'jadwal.jam_selesai',
            ])
            ->get();
        return $this->view('admin.jadwal.index', ['data' => $data]);
    }

    public function createIndex()
    {
        $kelas = DB::table('kelas')->get();
        $mapel = DB::table('mapel')->get();
        return $this->view('admin.jadwal.create', [
            'kelas' => $kelas,
            'mapel' => $mapel,
        ]);
    }

    public function create(Request $request)
    {
        $id_kelas = $request->input('id_kelas');
        $id_mapel = $request->input('id_mapel');
        $hari = $request->input('hari');
        $jam_mulai = $request->input('jam_mulai');
        $jam_selesai = $request->input('jam_selesai');

        if (empty($id_kelas) || empty($id_mapel) || empty($hari) || empty($jam_mulai) || empty($jam_selesai)) {
            die("Error: Semua kolom wajib diisi.");
        }

        DB::table('jadwal')->insert([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'hari' => $hari,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
        ]);

        return $this->redirect('/jadwal')->with('success', 'Data berhasil ditambahkan.');
    }

    public function updateIndex($id)
    {
        $data = DB::table('jadwal')->where('id', '=', $id)->first();
        if (!$data) {
            die("Error: Data tidak ditemukan.");
        }

        $kelas = DB::table('kelas')->get();
        $mapel = DB::table('mapel')->get();

        return $this->view('admin.jadwal.update', [
            'data' => $data,
            'kelas' => $kelas,
            'mapel' => $mapel,
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $id_kelas = $request->input('id_kelas');
        $id_mapel = $request->input('id_mapel');
        $hari = $request->input('hari');
        $jam_mulai = $request->input('jam_mulai');
        $jam_selesai = $request->input('jam_selesai');

        if (empty($id_kelas) || empty($id_mapel) || empty($hari) || empty($jam_mulai) || empty($jam_selesai)) {
            die("Error: Semua kolom wajib diisi.");
        }

        DB::table('jadwal')
            ->where('id', '=', $id)
            ->update([
                'id_kelas' => $id_kelas,
                'id_mapel' => $id_mapel,
                'hari' => $hari,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
            ]);

        return $this->redirect('/jadwal')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $data = DB::table('jadwal')->where('id', '=', $id)->first();
        if ($data) {
            DB::table('jadwal')->where('id', '=', $id)->delete();
        } else {
            die("Error: Data tidak ditemukan.");
        }

        return $this->redirect('/jadwal')->with('success', 'Data berhasil dihapus.');
    }
}

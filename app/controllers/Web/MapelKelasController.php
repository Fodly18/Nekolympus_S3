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
                'mapel.nama as nama_mapel',
'kelas.kelas as nama_kelas',
                'guru.nama as nama_guru',
            ])
            ->get();
        return $this->view('admin.mapelkelas.index', ['data' => $data]);
    }

    public function createIndex()
    {
        $mapel = DB::table('mapel')->get();
        $kelas = DB::table('kelas')->get();
        $guru = DB::table('guru')->get();
        return $this->view('admin.mapelkelas.create', [
            'mapel' => $mapel,
            'kelas' => $kelas,
            'guru' => $guru,
        ]);
    }

    public function create(Request $request)
    {
        $id_mapel = $request->input('id_mapel');
        $id_kelas = $request->input('id_kelas');
        $id_guru = $request->input('id_guru');

        if (empty($id_mapel) || empty($id_kelas) || empty($id_guru)) {
            die("Error: Semua kolom wajib diisi.");
        }

        DB::table('mapel_kelas')->insert([
            'id_mapel' => $id_mapel,
            'id_kelas' => $id_kelas,
            'id_guru' => $id_guru,
        ]);

        return $this->redirect('/mapelkelas')->with('success', 'Data berhasil ditambahkan.');
    }

    public function updateIndex($id)
    {
        $data = DB::table('mapel_kelas')->where('id', '=', $id)->first();
        if (!$data) {
            die("Error: Data tidak ditemukan.");
        }

        $mapel = DB::table('mapel')->get();
        $kelas = DB::table('kelas')->get();
        $guru = DB::table('guru')->get();

        return $this->view('admin.mapelkelas.update', [
            'data' => $data,
            'mapel' => $mapel,
            'kelas' => $kelas,
            'guru' => $guru,
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $id_mapel = $request->input('id_mapel');
        $id_kelas = $request->input('id_kelas');
        $id_guru = $request->input('id_guru');

        if (empty($id_mapel) || empty($id_kelas) || empty($id_guru)) {
            die("Error: Semua kolom wajib diisi.");
        }

        DB::table('mapel_kelas')
            ->where('id', '=', $id)
            ->update([
                'id_mapel' => $id_mapel,
                'id_kelas' => $id_kelas,
                'id_guru' => $id_guru,
            ]);

        return $this->redirect('/mapelkelas')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $data = DB::table('mapel_kelas')->where('id', '=', $id)->first();
        if ($data) {
            DB::table('mapel_kelas')->where('id', '=', $id)->delete();
        } else {
            die("Error: Data tidak ditemukan.");
        }

        return $this->redirect('/mapelkelas')->with('success', 'Data berhasil dihapus.');
    }
}

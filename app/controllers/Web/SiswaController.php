<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $data = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->select([
                'siswa.id as id',
                'siswa.nama as nama', 
                'siswa.nisn as nisn', 
                'siswa.nomor_hp as nomor_hp', 
                'kelas.kelas as kelas',
                ]) 
            ->get();

        return $this->view('admin.siswa.index', ['data' => $data]);
    }

    public function createIndex()
    {
        $data = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->select([
                'siswa.id as id',
                'siswa.nama as nama', 
                'siswa.nisn as nisn', 
                'siswa.nomor_hp as nomor_hp', 
                'kelas.kelas as kelas',
                ]) 
            ->get();

        $kelasData = DB::table('kelas')->select(['id', 'kelas'])->get();
        return $this->view('admin.siswa.create', ['data' => $kelasData]);
    }

    public function create(Request $request)
    {
        $Siswa = Siswa::create([
            'nisn' => $request->input('nisn'),
            'nama' => $request->input('nama'),
            'nomor_hp' => $request->input('nomor_hp'),
            'id_kelas' => $request->input('kelas'), // Change 'kelas' to 'id_kelas'
            'password' => password_hash($request->input('password'), PASSWORD_BCRYPT)
        ]);
        return $this->redirect('/siswa');
    }

    public function updateIndex($id)
    {
        $data = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->select([
                'siswa.id as id',
                'siswa.nama as nama', 
                'siswa.nisn as nisn', 
                'siswa.nomor_hp as nomor_hp', 
                'kelas.kelas as kelas',
                ]) 
            ->get();

            $kelasData = DB::table('kelas')->select(['id', 'kelas'])->get();
            return $this->view('admin.siswa.create', ['data' => $kelasData]);

        return $this->view('admin.siswa.update');
    }

    public function update(Request $request)
    {
        $siswa = Siswa::update($request->input('id'), [
            'nisn' => $request->input('nisn'),
            'nama' => $request->input('nama'),
            'nomor_hp' => $request->input('nomor_hp'),
            'id_kelas' => $request->input('id_kelas'),
            'password' => password_hash($request->input('password'), PASSWORD_BCRYPT)
        ]);
        return $this->redirect('/siswa');
    }

    public function delete($id)
    {
        Siswa::delete($id);

        return $this->redirect('/siswa');
    }
}

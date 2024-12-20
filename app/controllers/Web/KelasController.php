<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::all();
        foreach ($data as $kelas) {
            if (is_object($kelas)) {
                $kelas->guru = $kelas->guru(); // Fetch the associated guru
                // Debugging output to check id_guru
                error_log("Kelas ID: {$kelas->id}, id_guru: {$kelas->id_guru}");
            }
        }
        return $this->view('admin.kelas.index', ['data' => $data, 'no' => 1]);
    }

    public function createIndex()
    {
        return $this->view('admin.kelas.create');
    }

    public function create(Request $request)
    {
        if(!$request->validate([
            'kelas' => 'required'
        ])) {
            return $this->view('admin.kelas.create', ['errors' => $request->getErrors()]);
        }

        Kelas::create([
            'kelas' => $request->input('kelas')
        ]);

        return $this->redirect('/kelas');
    }

    public function updateIndex($id)
    {
        $data = Kelas::where('id', '=', $id)->first();
        $guruList = DB::table('guru')->get(); // Fetch all guru for the dropdown
        return $this->view('admin.kelas.update', ['data' => $data]);
    }

    public function update(Request $request)
    {
        if(!$request->validate([
            'kelas' => 'required'
        ])) {
            return $this->view('admin.kelas.update', ['errors' => $request->getErrors()]);
        }

        Kelas::update($request->input('id'), [
            'kelas' => $request->input('kelas'),
            'id_guru' => $request->input('guru_id'), // Update the guru ID
        ]);

        return $this->redirect('/kelas');
    }

    public function delete($id)
    {
        Kelas::delete($id);
        return $this->redirect('/kelas');
    }
}

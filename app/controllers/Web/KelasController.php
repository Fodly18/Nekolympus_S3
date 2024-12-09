<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::all();
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
        return $this->view('admin.kelas.update', ['data' => $data]);
    }

    public function update(Request $request)
    {
        if(!$request->validate([
            'kelas' => 'kelas'
        ])) {
            return $this->view('admin.kelas.update', ['errors' => $request->getErrors()]);
        }

        Kelas::update($request->input('id'), [
            'kelas' => $request->input('kelas')
        ]);

        return $this->redirect('/kelas');
    }

    public function delete($id)
    {
        Kelas::delete($id);

        return $this->redirect('/kelas');
    }
}
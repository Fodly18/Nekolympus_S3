<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Mapel;

class MapelController extends Controller
{
    public function index()
    {
        $data = Mapel::all();
        return $this->view('admin.mapel.index', ['data' => $data, 'no' => 1]);
    }

    public function createIndex()
    {
        return $this->view('admin.mapel.create');
    }

    public function create(Request $request)
    {
        if(!$request->validate([
            'mapel' => 'required'
        ])) {
            return $this->view('admin.mapel.create', ['errors' => $request->getErrors()]);
        }

        Mapel::create([
            'nama' => $request->input('mapel')
        ]);

        return $this->redirect('/mapel');
    }

    public function updateIndex($id)
    {
        $data = Mapel::where('id', '=', $id)->first();
        return $this->view('admin.mapel.update', ['data' => $data]);
    }

    public function update(Request $request)
    {
        if(!$request->validate([
            'mapel' => 'required'
        ])) {
            return $this->view('admin.mapel.update', ['errors' => $request->getErrors()]);
        }

        Mapel::update($request->input('id'), [
            'nama' => $request->input('mapel')
        ]);

        return $this->redirect('/mapel');
    }

    public function delete($id)
    {
        Mapel::delete($id);

        return $this->redirect('/mapel');
    }
}
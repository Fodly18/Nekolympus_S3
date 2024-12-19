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
        return $this->view('admin.mapel.index', ['data' => $data]);
    }

    public function createIndex()
    {
        return $this->view('admin.mapel.create');
    }

    public function create(Request $request)
    {
        if (!$request->validate([
            'nama' => 'required|max:100'
        ])) {
            return $this->view('admin.mapel.create', [
                'errors' => $request->getErrors()
            ]);
        }

        $result = Mapel::create([
            'nama' => $request->input('nama')
        ]);

        if ($result) {
            return $this->redirect('/mapel');
        } else {
            return $this->view('admin.mapel.create', [
                'errors' => ['system' => ['Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']]
            ]);
        }
    }

    public function updateIndex($id)
    {
        $data = Mapel::where('id', '=', $id)->first();

        if ($data) {
            return $this->view('admin.mapel.update', ['data' => $data]);
        } else {
            return $this->redirect('/mapel', [
                'errors' => ['system' => ['Data tidak ditemukan.']]
            ]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        $currentData = Mapel::where('id', '=', $id)->first();
        if (!$currentData) {
            return $this->redirect('/mapel');
        }

        if (!$request->validate([
            'id' => 'required',
            'nama' => 'required'
        ])) {
            return $this->view('admin.mapel.update', [
                'errors' => $request->getErrors(),
                'data' => $currentData
            ]);
        }

        $result = Mapel::update($id, [
            'nama' => $request->input('nama')
        ]);

        if ($result) {
            return $this->redirect('/mapel');
        } else {
            return $this->view('admin.mapel.update', [
                'errors' => ['system' => ['Terjadi kesalahan saat memperbarui data. Silakan coba lagi.']],
                'data' => $currentData
            ]);
        }
    }

    public function delete($id)
    {
        $mapel = Mapel::where('id', '=', $id)->first();

        if ($mapel) {
            $result = Mapel::delete($id);

            if (!$result) {
                // Log error or handle failure if needed
            }
        }

        return $this->redirect('/mapel');
    }
}

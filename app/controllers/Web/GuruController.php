<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        $data = Guru::all();
        return $this->view('guru.index', ['data' => $data, 'no' => 1]);
    }

    public function createIndex()
    {
        return $this->view('guru.create');
    }

    public function create(Request $request)
    {
        if(!$request->validate([
            'guru' => 'required'
        ])) {
            return $this->view('guru.create', ['errors' => $request->getErrors()]);
        }

        Guru::create([
            'nip' => $request->input('guru'),
            'nomor_hp' => $request->input('guru'),
            'nama' => $request->input('guru'),
            'password' => $request->input('guru')
        ]);

        return $this->redirect('/guru');
    }

    public function updateIndex($id)
    {
        $data = Guru::where('id', '=', $id)->first();
        return $this->view('guru.update', ['data' => $data]);
    }

    public function update(Request $request)
    {
        if(!$request->validate([
            'guru' => 'required'
        ])) {
            return $this->view('guru.update', ['errors' => $request->getErrors()]);
        }

        Guru::update($request->input('id'), [
            'nip' => $request->input('guru'),
            'nomor_hp' => $request->input('guru'),
            'nama' => $request->input('guru'),
            'password' => $request->input('guru')
        ]);

        return $this->redirect('/guru');
    }

    public function delete($id)
    {
        Guru::delete($id);

        return $this->redirect('/guru');
    }
}
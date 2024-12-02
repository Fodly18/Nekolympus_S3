<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $data = Siswa::all();
        return $this->view('admin.siswa.index', ['data' => $data]);
    }

    public function createIndex()
    {
        return $this->view('admin.siswa.create');
    }

    public function create(Request $request)
    {
        // Validate phone number format
        $nomor_hp = $request->input('nomor_hp');
        if (!preg_match('/^[0-9]{10,13}$/', $nomor_hp)) {
            return $this->view('admin.siswa.create', [
                'errors' => ['nomor_hp' => ['Nomor HP harus berupa angka dan panjang 10-13 digit']]
            ]);
        }

        // Validate NISN format
        $nisn = $request->input('nisn');
        $existingSiswa = Siswa::where('nisn', '=', $nisn)->first();
        if ($existingSiswa) {
            return $this->view('admin.siswa.create', [
                'errors' => ['nisn' => ['NISN sudah Digunakan']]
            ]);
        }
        if (!preg_match('/^[0-9]{10}$/', $nisn)) {
            return $this->view('admin.siswa.create', [
                'errors' => ['nisn' => ['nisn harus berupa 10 digit angka']]
            ]);
        }


        try {
            Siswa::create([
                'nisn' => $nisn,
                'nomor_hp' => $nomor_hp,
                'nama' => $request->input('nama'),
                'password' => password_hash($request->input('password'), PASSWORD_BCRYPT)
            ]);
            return $this->redirect('/siswa');
        } catch (\Exception $e) {
            return $this->view('admin.siswa.create', [
                'errors' => ['system' => ['Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']]
            ]);
        }
    }

    public function updateIndex($id)
    {
        try {
            $data = Siswa::where('id', '=', $id)->first();
            if (!$data) {
                return $this->redirect('/siswa');
            }
            return $this->view('admin.siswa.update', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->redirect('/siswa');
        }
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        
        // Get current data for error display
        $currentData = Siswa::where('id', '=', $id)->first();
        if (!$currentData) {
            return $this->redirect('/siswa');
        }

        // Validate phone number format
        $nomor_hp = $request->input('nomor_hp');
        if (!preg_match('/^[0-9]{10,13}$/', $nomor_hp)) {
            return $this->view('admin.siswa.update', [
                'errors' => ['nomor_hp' => ['Nomor HP harus berupa angka dan panjang 10-13 digit']],
                'data' => $currentData
            ]);
        }

        // Validate nisn format
        $nisn = $request->input('nisn');
        if (!preg_match('/^[0-9]{10}$/', $nisn)) {
            return $this->view('admin.siswa.update', [
                'errors' => ['nisn' => ['nisn harus berupa 10 digit angka']],
                'data' => $currentData
            ]);
        }

        if (!$request->validate([
            'id' => 'required',
            'nisn' => 'required',
            'nama' => 'required',
            'nomor_hp' => 'required'
        ])) {
            return $this->view('admin.siswa.update', [
                'errors' => $request->getErrors(),
                'data' => $currentData
            ]);
        }

        try {
            $updateData = [
                'nisn' => $nisn,
                'nomor_hp' => $nomor_hp,
                'nama' => $request->input('nama')
            ];

            // Only update password if a new one is provided
            $password = $request->input('password');
            if (!empty($password)) {
                if (strlen($password) < 6) {
                    return $this->view('admin.siswa.update', [
                        'errors' => ['password' => ['Password minimal 6 karakter']],
                        'data' => $currentData
                    ]);
                }
                $updateData['password'] = password_hash($password, PASSWORD_BCRYPT);
            }

            Siswa::update($id, $updateData);
            return $this->redirect('/siswa');
        } catch (\Exception $e) {
            return $this->view('admin.siswa.update', [
                'errors' => ['system' => ['Terjadi kesalahan saat memperbarui data. Silakan coba lagi.']],
                'data' => $currentData
            ]);
        }
    }

    public function delete($id)
    {
        try {
            // Check if siswa exists
            $siswa = Siswa::where('id', '=', $id)->first();
            if ($siswa) {
                Siswa::delete($id);
            }
        } catch (\Exception $e) {
            // Log error if needed
        }
        return $this->redirect('/siswa');
    }
}

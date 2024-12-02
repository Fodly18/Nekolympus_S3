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
        return $this->view('admin.guru.index', ['data' => $data]);
    }

    public function createIndex()
    {
        return $this->view('admin.guru.create');
    }

    public function create(Request $request)
    {
        // Validate phone number format
        $nomor_hp = $request->input('nomor_hp');
        if (!preg_match('/^[0-9]{10,13}$/', $nomor_hp)) {
            return $this->view('admin.guru.create', [
                'errors' => ['nomor_hp' => ['Nomor HP harus berupa angka dan panjang 10-13 digit']]
            ]);
        }

        // Validate NIP format
        $nip = $request->input('nip');
        $existingGuru = Guru::where('nip', '=', $nip)->first();
        if ($existingGuru) {
            return $this->view('admin.guru.create', [
                'errors' => ['nip' => ['NIP sudah Digunakan']]
            ]);
        }
        if (!preg_match('/^[0-9]{18}$/', $nip)) {
            return $this->view('admin.guru.create', [
                'errors' => ['nip' => ['NIP harus berupa 18 digit angka']]
            ]);
        }


        try {
            Guru::create([
                'nip' => $nip,
                'nomor_hp' => $nomor_hp,
                'nama' => $request->input('nama'),
                'password' => password_hash($request->input('password'), PASSWORD_BCRYPT)
            ]);
            return $this->redirect('/guru');
        } catch (\Exception $e) {
            return $this->view('admin.guru.create', [
                'errors' => ['system' => ['Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']]
            ]);
        }
    }

    public function updateIndex($id)
    {
        try {
            $data = Guru::where('id', '=', $id)->first();
            if (!$data) {
                return $this->redirect('/guru');
            }
            return $this->view('admin.guru.update', ['data' => $data]);
        } catch (\Exception $e) {
            return $this->redirect('/guru');
        }
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        
        // Get current data for error display
        $currentData = Guru::where('id', '=', $id)->first();
        if (!$currentData) {
            return $this->redirect('/guru');
        }

        // Validate phone number format
        $nomor_hp = $request->input('nomor_hp');
        if (!preg_match('/^[0-9]{10,13}$/', $nomor_hp)) {
            return $this->view('admin.guru.update', [
                'errors' => ['nomor_hp' => ['Nomor HP harus berupa angka dan panjang 10-13 digit']],
                'data' => $currentData
            ]);
        }

        // Validate NIP format
        $nip = $request->input('nip');
        if (!preg_match('/^[0-9]{18}$/', $nip)) {
            return $this->view('admin.guru.update', [
                'errors' => ['nip' => ['NIP harus berupa 18 digit angka']],
                'data' => $currentData
            ]);
        }

        if (!$request->validate([
            'id' => 'required',
            'nip' => 'required',
            'nama' => 'required',
            'nomor_hp' => 'required'
        ])) {
            return $this->view('admin.guru.update', [
                'errors' => $request->getErrors(),
                'data' => $currentData
            ]);
        }

        try {
            $updateData = [
                'nip' => $nip,
                'nomor_hp' => $nomor_hp,
                'nama' => $request->input('nama')
            ];

            // Only update password if a new one is provided
            $password = $request->input('password');
            if (!empty($password)) {
                if (strlen($password) < 6) {
                    return $this->view('admin.guru.update', [
                        'errors' => ['password' => ['Password minimal 6 karakter']],
                        'data' => $currentData
                    ]);
                }
                $updateData['password'] = password_hash($password, PASSWORD_BCRYPT);
            }

            Guru::update($id, $updateData);
            return $this->redirect('/guru');
        } catch (\Exception $e) {
            return $this->view('admin.guru.update', [
                'errors' => ['system' => ['Terjadi kesalahan saat memperbarui data. Silakan coba lagi.']],
                'data' => $currentData
            ]);
        }
    }

    public function delete($id)
    {
        try {
            // Check if guru exists
            $guru = Guru::where('id', '=', $id)->first();
            if ($guru) {
                Guru::delete($id);
            }
        } catch (\Exception $e) {
            // Log error if needed
        }
        return $this->redirect('/guru');
    }
}

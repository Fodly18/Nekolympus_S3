<?php

namespace Nekolympus\Project\controllers\Api;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Helper;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Siswa;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        if(!$request->validate([
            'nisn' => 'required',
            'password' => 'required|min:8'
        ])) {
            return $this->json([
                'status' => 'errors',
                'message' => 'validation error',
                'data' => $request->getErrors()
            ]);
        }

        $nisn = $request->input('nisn');

        $user = Siswa::where('nisn', '=', $nisn)->first();

        if(!Helper::bcryptVerify($request->input('password'), $user->password)) 
        {
            return $this->json([
                'status' => 'errors',
                'message' => 'Username atau password salah'
            ]);
        }
        $token = bin2hex(random_bytes(32));
        Siswa::update($user->id, ['token' => $token]);

        return $this->json([
            'status' => 'success',
            'message' => 'Login Berhasil',
            'data' => [
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

    public function Logout(Request $request)
    {
        if($request->bearerToken() == null) {
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.'
            ]);
        }

        $data = Siswa::where('token', '=', $request->bearerToken())->first();

        if(!$data) {
            return $this->json([
                'status' => 'errors',
                'message' => 'Token Tidak Valid'
            ]);
        }

        Siswa::update($data->id, ['token' => '']);

        return $this->json([
            'status' => 'success',
            'message' => 'Logout Berhasil'
        ]);
    }

    public function profile(Request $request)
    {
        $token = $request->bearerToken();

        if(!$token){
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.'
            ]);
        }

        $data = Siswa::join([
            ['table' => 'kelas', 'baseColumn' => 'id_kelas', 'joinColumn' => 'id']
        ],[
            'token' => $token
        ],[
            'siswa.id', 'siswa.nisn', 'siswa.nama', 'siswa.nomor_hp', 'kelas.kelas'
        ]);

        if(!$data) {
            return $this->json([
                'status' => 'errors',
                'message' => 'Token Tidak Valid'
            ]);
        }
        
        return $this->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}

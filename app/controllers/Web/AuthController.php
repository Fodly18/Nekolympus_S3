<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Helper;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Admin;
use Nekolympus\Project\models\Guru;

class AuthController extends Controller
{
    public function indexAdmin()
    {
        return $this->view('auth.login-admin');
    }


    public function LoginAdmin(Request $request)
    {
        // Validasi input
        $errors = [];
    
        // Validasi kolom username
        if (!$request->input('username')) {
            $errors['username'][] = 'Username wajib diisi.';
        }
    
        // Validasi kolom password
        if (!$request->input('password')) {
            $errors['password'][] = 'Password wajib diisi.';
        } elseif (strlen($request->input('password')) < 8) {
            $errors['password'][] = 'Password minimal 8 karakter.';
        }
    
        // Jika ada error validasi input, kembalikan view dengan error
        if (!empty($errors)) {
            return $this->view('auth.login-admin', ['errors' => $errors]);
        }
    
        // Ambil username dan password
        $username = $request->input('username');
        $password = $request->input('password');
    
        // Cari user berdasarkan username
        $user = Admin::where('username', '=', $username)->first();
   
        // Validasi login
        if (!$user) {
            // Jika username tidak ditemukan
            $errors['username'][] = 'Username tidak ditemukan.';
        } elseif (!Helper::bcryptVerify($password, $user->password)) {
            // Jika password salah
            $errors['password'][] = 'Password salah.';

        }
    
        // Jika ada error saat validasi username atau password
        if (!empty($errors)) {
            return $this->view('auth.login-admin', ['errors' => $errors]);
        }
    
        // Jika berhasil login
        $_SESSION['user_role'] = 'admin';
        $_SESSION['user'] = true;
        $_SESSION['auth'] = $user->id;
    
        return $this->redirect('/dashboard-admin');
    }
    


    public function logoutAdmin()
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
        return $this->view('auth.login-admin');
    }

    public function logoutGuru()
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
        return $this->view('auth.login-guru');
    }

    public function indexGuru()
    {
        return $this->view('auth.login-guru');
    }

    public function LoginGuru(Request $request)
    {
        $errors = [];
        // Validasi kolom nip
        if (!$request->input('nip')) {
            $errors['nip'][] = 'nip wajib diisi.';
        }

        // Validasi kolom password
        if (!$request->input('password')) {
            $errors['password'][] = 'Password wajib diisi.';
        } elseif (strlen($request->input('password')) < 8) {
            $errors['password'][] = 'Password minimal 8 karakter.';
        }

        // Jika ada error validasi input, kembalikan view dengan error
        if (!empty($errors)) {
            return $this->view('auth.login-guru', ['errors' => $errors]);
        }

        // Ambil nip dan password
        $nip = $request->input('nip');
        $password = $request->input('password');

        // Cari user berdasarkan nip
        $user = Guru::where('nip', '=', $nip)->first();

        // Validasi login
        if (!$user) {
            // Jika nip tidak ditemukan
            $errors['nip'][] = 'nip tidak ditemukan.';
        } elseif (!Helper::bcryptVerify($password, $user->password)) {
            // Jika password salah
            $errors['password'][] = 'Password salah.';
        }

        // Jika ada error saat validasi nip atau password
        if (!empty($errors)) {
            return $this->view('auth.login-guru', ['errors' => $errors]);
        }

        // Jika berhasil login
        $_SESSION['user_role'] = 'guru';
        $_SESSION['user'] = true;
        $_SESSION['auth'] = $user->id;

        return $this->redirect('/dashboard-guru');
    }
}

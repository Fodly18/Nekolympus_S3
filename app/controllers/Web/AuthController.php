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
        if(!$request->validate([
            'username' => 'required',
            'password' => 'required|min:8'
        ])) {
            return $this->view('auth.login-admin', ['errors' => $request->getErrors()]);
        }
        
        $username = $request->input('username');

        $user = Admin::where('username', '=', $username)->first();
        if(Helper::bcryptVerify($request->input('password'), $user->password)) 
        {
            $_SESSION['user_role'] = 'admin';
            $_SESSION['user'] = true;
            return $this->redirect('/dashboard-admin');
        }

        return $this->view('auth.login-admin', ['error' => 'Username Atau Password Salah']);
    }

    public function logoutAdmin()
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
        return $this->redirect('auth.login-admin');  
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
        if(!$request->validate([
            'nip' => 'required',
            'password' => 'required|min:8'
        ])) {
            return $this->view('auth.login-guru', ['errors' => $request->getErrors()]);
        }
        
        $username = $request->input('nip');

        $user = Guru::where('nip', '=', $username)->first();
        if(Helper::bcryptVerify($request->input('password'), $user->password)) 
        {
            $_SESSION['user_role'] = 'guru';
            $_SESSION['user'] = true;
            return $this->redirect('/dashboard-guru');
        }

        return $this->view('auth.login-guru', ['error' => 'NIP Atau Password Salah']);
    }
}
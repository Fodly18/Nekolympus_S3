<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Helper;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Admin;

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
}
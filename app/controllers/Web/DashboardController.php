<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->view('admin.index');
    }

    public function logout()
    {
        return $this->view('auth.login-admin');
    }
}
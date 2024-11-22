<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;

class DashboardController extends Controller
{
    public function indexAdmin()
    {
        return $this->view('admin.index');
    }

    public function indexGuru()
    {
        return $this->view('guru.index');
    }

    public function logout()
    {
        return $this->view('home.index');
    }
    
}
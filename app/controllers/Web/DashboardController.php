<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->view('home', ['title' => 'dashboard']);
    }
}
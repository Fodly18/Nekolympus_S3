<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Helper;
use Nekolympus\Project\core\View;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Barang;

class HomeController extends Controller
{
    public function index()
    {
        return  $this->view('home.index');
    }

    public function sejarah()
    {
        return  $this->view('html.sejarah');
    }

    public function Visi_misi()
{
    return $this->view('html.Visi-misi');
    
}


}
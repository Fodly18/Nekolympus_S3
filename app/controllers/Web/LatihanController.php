<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\models\LatihanSoal;

class LatihanController extends Controller
{
    public function createIndex()
    {
        return $this->view('guru.latihan-soal.create');
    }

    public function create()
    {

    }

    public function updateIndex()
    {
        return $this->view('guru.latihan-soal.update');
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}

?>
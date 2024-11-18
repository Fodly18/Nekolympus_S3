<?php

namespace Nekolympus\Project\controllers\Api;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Barang;

class TestApiController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return $this->json([
            'status' => 'success',
            'message' => 'This is a test API response',
            'data' => $barang
        ]);
    }

    public function data(Request $request)
    {
        $name = $request->input('name');
        $age = $request->input('age');

        if (!$name || !$age) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid data'
            ]);
            return;
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Data received successfully',
            'data' => [
                'name' => $name,
                'age' => $age
            ]
        ]);
    }
}

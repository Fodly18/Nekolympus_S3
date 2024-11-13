<?php

namespace Nekolympus\Project\core;

class Controller 
{
    public function view($path, $data = [])
    {
        return View::render($path, $data);
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit();
    }

    public function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}

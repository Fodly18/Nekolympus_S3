<?php

namespace Nekolympus\Project\core;

class View 
{
    public static function render($view, $data = []) {
        $viewPath = __DIR__ . '/../../views/' . str_replace('.', '/', $view) . '.php';

        if (file_exists($viewPath)) {
            extract($data);

            include $viewPath;
        } else {
            echo "View file '$viewPath' not found.";
        }
    }
}

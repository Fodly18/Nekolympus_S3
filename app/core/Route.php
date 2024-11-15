<?php

namespace Nekolympus\Project\core;

class Route
{
    private static $routes = [];
    private static $prefix = '';
    private $middlewares = []; // Menyimpan middleware untuk setiap rute yang aktif

    public static function get($uri, $controller, $action)
    {
        $route = new self;
        $route->add('GET', $uri, $controller, $action);
        return $route;
    }

    public static function post($uri, $controller, $action)
    {
        $route = new self;
        $route->add('POST', $uri, $controller, $action);
        return $route;
    }

    private function add($method, $uri, $controller, $action)
    {
        $uri = self::$prefix . $uri;

        // Simpan rute tanpa middleware di sini
        self::$routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action,
            'routeObject' => $this, // Menyimpan objek route ini dengan middleware yang aktif
        ];
    }

    public function middleware(array $middlewares)
    {
        $this->middlewares = $middlewares; // Menetapkan middleware untuk rute saat ini
        return $this; // Agar bisa chaining
    }

    public static function handleRequest($url, $method)
    {
        foreach (self::$routes as $route) {

            // Menyesuaikan pattern untuk menangkap parameter dalam curly braces (seperti {id})
            $pattern = "#^" . preg_replace("/{[a-zA-Z0-9_]+}/", "([a-zA-Z0-9_-]+)", $route['uri']) . "$#";
    
            // Cek method dan pola URL
            if ($route['method'] === $method && preg_match($pattern, $url, $matches)) {
                array_shift($matches); // Hapus elemen pertama yang berisi URL lengkap
    
                // Middleware proses
                $currentRoute = $route['routeObject'];
                $middlewares = $currentRoute->middlewares;
    
                foreach ($middlewares as $middlewareName) {
                    $middlewareInstance = Middleware::getMiddleware($middlewareName);
                    if ($middlewareInstance) {
                        $response = $middlewareInstance->handle(function () {
                            return true;
                        });
    
                        if ($response === false) {
                            return;
                        }
                    }
                }
    
                // Controller dan action
                $controller = $route['controller'];
                $action = $route['action'];
    
                // Membuat instance controller
                $controllerInstance = new $controller;
    
                // Jika metode adalah POST, buat objek request
                $parameters = $matches; // Default hanya parameter dari URL
                if ($method !== 'GET') {
                    $request = new Request();
                    $parameters = array_merge([$request], $matches);
                }
    
                // Panggil fungsi controller dengan parameter yang sesuai
                call_user_func_array([$controllerInstance, $action], $parameters);

                return;
            }
        }
        echo "404 Not Found";
    }



    public static function prefix($prefix)
    {
        self::$prefix = $prefix;
    }
}
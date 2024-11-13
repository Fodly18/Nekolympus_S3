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
            $pattern = "#^" . preg_replace("/{[a-zA-Z0-9_]+}/", "([a-zA-Z0-9_-]+)", $route['uri']) . "$#";
            if ($route['method'] === $method && preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                // Mengakses middleware dari objek route yang aktif
                $currentRoute = $route['routeObject'];
                $middlewares = $currentRoute->middlewares;

                // Jalankan setiap middleware
                foreach ($middlewares as $middlewareName) {
                    $middlewareInstance = Middleware::getMiddleware($middlewareName);
                    if ($middlewareInstance) {
                        $response = $middlewareInstance->handle(function() {
                            return true; // Fungsi callback untuk melanjutkan ke rute berikutnya
                        });

                        // Jika middleware mengembalikan false, hentikan eksekusi
                        if ($response === false) {
                            return; // Middleware gagal
                        }
                    }
                }

                $controller = $route['controller'];
                $action = $route['action'];
                $controllerInstance = new $controller;

                // Tambahkan objek Request sebagai parameter saat GET method dipanggil
                $request = new Request();
                if ($method == 'POST') {
                    call_user_func_array([$controllerInstance, $action], [$request]);
                } else {
                    call_user_func_array([$controllerInstance, $action], array_merge([$request], $matches));
                }
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
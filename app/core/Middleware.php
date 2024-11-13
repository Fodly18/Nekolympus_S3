<?php

namespace Nekolympus\Project\core;

class Middleware
{
    private static $middlewares = [];

    public static function register($name, $middlewareClass)
    {
        self::$middlewares[$name] = $middlewareClass;
    }

    public static function getMiddleware($name)
    {
        return isset(self::$middlewares[$name]) ? new self::$middlewares[$name] : null;
    }
}

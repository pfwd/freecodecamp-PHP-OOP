<?php
namespace App\Helper\HTTP\Route;

class Router
{
    /**
     * @var array
     */
    private static $routes = [];

    /**
     * @param Route $route
     */
    public static function add(Route $route) {
        self::$routes[$route->getPattern()] = $route;
    }

    /**
     * @return array
     */
    public function getRoutes():array
    {
        return self::$routes;
    }

}
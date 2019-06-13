<?php
namespace App\Helper\Route;
use Exception;

class Router
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @param Route $route
     *
     * @return $this
     */
    public function register(Route $route)
    {
        $this->routes[$route->getPattern()] = $route;

        return $this;
    }

    /**
     * @param string $currentURI
     *
     * @return Route
     *
     * @throws Exception
     */
    public function process(string $currentURI): Route
    {
        if(false === isset($this->routes[$currentURI])) {
            throw new Exception('Cannot find route for '. $currentURI, 404);
        }

        return $this->routes[$currentURI];
    }

    /**
     * @return array
     */
    public function getRoutes():array
    {
        return $this->routes;
    }

}
<?php
namespace App\Helper\Route;
use Exception;

class Processor
{
    /**
     * @param Router $router
     * @param string $currentURI
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function run(Router $router, string $currentURI){
        $parsedURL = parse_url($currentURI);

        $path = $parsedURL['path'];

        foreach($router->getRoutes() as $pattern => $route) {
            if (false === $route instanceof Route){
                throw new Exception('This not a route');
            }

            if(preg_match('#^'.$pattern.'$#', $path, $matches )) {

                $controllerName = $route->getController();
                $controller = new $controllerName();

                break;
            }
        }

        return $controller->{$route->getMethods()}();
    }

    /**
     * @param $routes
     * @return Router
     *
     * @throws Exception
     */
    public function make($routes)
    {
        $router = new Router();

        foreach($routes as $routeData)
        {
            $route = new Route($routeData);
            $router->register($route);
        }

        return $router;
    }
}
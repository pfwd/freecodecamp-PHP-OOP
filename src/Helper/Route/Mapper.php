<?php
namespace App\Helper\Route;
use Exception;

class Mapper
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

        // 1) Get path from $currentURI
        $parsedURL = parse_url($currentURI);

        $path = $parsedURL['path'];

        // 2) Get array of routes
        foreach($router->getRoutes() as $pattern => $route) {
            // 3) Check instance of Route
            if (false === $route instanceof Route){
                // 4) Throw exception
                throw new Exception('This not a route');
            }

            // 5) Handle pattern
            if(preg_match('#^'.$pattern.'$#', $path, $matches )) {
                // 6) Construct controller
                $controllerName = $route->getController();
                $controller = new $controllerName();

                break;
            }
        }
        // 7) Get method
        // 8) Returning method
        return $controller->{$route->getMethod()}();
    }

}
<?php
namespace App\Helper\Kernel;

use App\Helper\HTTP\Locator\Locator;
use App\Helper\HTTP\Request\Request;
use App\Helper\HTTP\Route\Route;
use Exception;

class Kernel
{
    public static function boot(array $routes)
    {
        $request = new Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

        $locator = new Locator($request, $routes);
        $route = $locator->locate();

        if(false === $route instanceof Route) {
            throw new Exception('Cannot find page', 404);
        }
        $controllerName = $route->getController();

        $controller = new $controllerName();

        return $controller->{$route->getAction()}();
    }

}

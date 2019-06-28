<?php
namespace App\Helper\Kernel;

use App\Helper\HTTP\Request\Factory\Type\ServerFactory;
use App\Helper\HTTP\Locator\Locator;
use App\Helper\HTTP\Route\Route;
use Exception;

class Kernel
{
    /**
     * @param array $routes
     *
     * @return mixed
     *
     * @throws Exception
     */
    public static function boot(array $routes)
    {
        $request = ServerFactory::make();
        $locator = new Locator($request, $routes);
        $route = $locator->locate();

        if(false === $route instanceof Route) {
            throw new Exception('Cannot find page', 404);
        }
        $controllerName = $route->getController();

        $controller = new $controllerName();

        return $controller->{$route->getAction()}($request);
    }

}

<?php
namespace App\Helper\HTTP\Route;

use App\Helper\HTTP\Route\Validation\Validation;

class Factory
{
    /**
     * @var array
     */
    private $routes;


    /**
     * @param array $routes
     *
     * @return array
     */
    public function makeRoutes(array $routes): array
    {
        foreach($routes as $routeData) {
            $this->routes[] = $this->addRoute($routeData);
        }

        return $this->routes;

    }

    /**
     * @param array $options
     *
     * @return null|Route
     */
    public function addRoute(array $options):?Route
    {
        $route = new Route();
        $route->setAction($options['action'])
            ->setController($options['controller'])
            ->setMethods($options['method'])
            ->setPattern($options['pattern'])
        ;

        return $route;
    }

//    /**
//     * @param Route $route
//     */
//    protected function process(Route $route)
//    {
//        $isValid = $this->validation->validate($route);
//
//        if ($isValid) {
//            $this->routes[] = $route;
//        }
//    }



}
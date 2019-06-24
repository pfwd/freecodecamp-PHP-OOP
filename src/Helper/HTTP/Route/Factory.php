<?php
namespace App\Helper\HTTP\Route;

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
            ->setParameters((isset($options['parameters']) ? $options['parameters'] : []) )
        ;

        return $route;
    }

}
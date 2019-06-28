<?php
namespace App\Helper\HTTP\Locator;

use App\Helper\HTTP\Request\Request;
use App\Helper\HTTP\Route\Route;
use App\Helper\HTTP\URI\URIBuilder;

class Locator
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var array
     */
    private $routes = [];

    /**
     * Locator constructor.
     *
     * @param Request|null      $request
     * @param array             $routes
     */
    public function __construct(Request $request = null, array $routes = [])
    {
        $this->routes = $routes;

        if(null === $request) {
            $request = new Request();
        }

        $this->request = $request;
    }

    /**
     * @param string $URI
     * @param string $queryString
     *
     * @return null|array
     */
    public function matchURI(string $URI, string $queryString):?array
    {
        $foundRoute = null;
        preg_match($URI, $queryString, $matches);

        if(false === empty($matches)) {
            return $matches;
        }

        return null;
    }

    /**
     * @return Route|null
     */
    public function locate():?Route
    {
        $foundRoute = null;
        $queryString = $this->request->getPath();

        foreach($this->routes as $route) {

            $URI = URIBuilder::build($route->getPattern(), $route->getParameters());

            $matches = $this->matchURI($URI, $queryString);
            if(false === empty($matches)) {
                $this->handleRequestParameters($route, $matches);
                $foundRoute = $route;
                break;
            }
        }

        return $foundRoute;
    }

    /**
     * @param Route $route
     * @param array   $parameters
     *
     * @return Request
     */
    public function handleRequestParameters(Route $route, array $parameters = []): Request
    {
        if(isset($parameters[0])) {
            unset($parameters[0]);
        }

        $parameters = array_values($parameters);

        // Parameters: [0] => 123
        // $route->getParameters() : ['id'] => ([0-9]*)
        // $route->getParameters() Keys : [0] => 'id'
        // Updated Parameters ['id'] => 123
        // [<Route.Parameters.Key>] = [<Parameters.value>]


        $updated = array_combine(array_keys($route->getParameters()), $parameters);

        if($updated) {
            $this->request->setParameters($updated);
        }

        return $this->request;
    }
}
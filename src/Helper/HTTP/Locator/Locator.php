<?php
namespace App\Helper\HTTP\Locator;

use App\Helper\HTTP\Request\Request;
use App\Helper\HTTP\Route\Route;

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
     * @var URIPatternBuilder
     */
    private $URIPatternBuilder;

    /**
     * Locator constructor.
     *
     * @param URIPatternBuilder $URIPatternBuilder
     * @param Request|null      $request
     * @param array             $routes
     */
    public function __construct(URIPatternBuilder $URIPatternBuilder, Request $request = null, array $routes = [])
    {
        $this->URIPatternBuilder = $URIPatternBuilder;
        $this->routes = $routes;

        if(null === $request) {
            $this->request = new Request();
        }
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
            $URI = $this->createURI($route->getPattern(), $route->getParameters());

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
     * @param string $raw
     * @param array  $parameters
     *
     * @return string
     */
    public function createURI(string $raw = '', array $parameters = []): string
    {
        return $this->URIPatternBuilder
            ->setRaw($raw)
            ->setParameters($parameters)
            ->build()
        ;
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

        $updated = array_combine(array_keys($route->getParameters()), $parameters);

        if($updated) {
            $this->request->setParameters($updated);
        }

        return $this->request;
    }

}
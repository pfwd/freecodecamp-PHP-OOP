<?php
namespace App\Helper\HTTP\Validation;

use App\Helper\HTTP\Route\Route;

abstract class AbstractType
{
    /**
     * @var Route
     */
    protected $route;

    /**
     * @param Route $route
     *
     * @return mixed
     */
    public function setRoute(Route $route)
    {
        $this->route = $route;
    }

}
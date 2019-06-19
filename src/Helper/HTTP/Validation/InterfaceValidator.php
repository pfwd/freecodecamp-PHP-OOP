<?php
namespace App\Helper\HTTP\Validation;

use App\Helper\HTTP\Route\Route;

interface InterfaceValidator
{
    /**
     * @return bool
     */
    public function isValid():bool;

    /**
     * @param Route $route
     *
     * @return mixed
     */
    public function setRoute(Route $route);
}
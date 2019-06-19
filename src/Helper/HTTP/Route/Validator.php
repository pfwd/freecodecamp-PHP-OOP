<?php
namespace App\Helper\HTTP\Route;

use App\Helper\HTTP\Validation\Validation;
use Exception;

class Validator
{
    /**
     * @param array $routes
     * @param Validation $validation
     *
     * @return bool
     *
     * @throws Exception
     */
    public static function validate(array $routes, Validation $validation): bool
    {
        $isValid = false;
        foreach($routes as $route) {
            $isValid = $validation->validate($route);
            if(false === $isValid) {
                throw new Exception('Validator failed '. get_class($route));
                break;
            }
        }

        return $isValid;
    }



}
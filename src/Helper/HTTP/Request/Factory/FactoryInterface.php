<?php
namespace App\Helper\HTTP\Request\Factory;

use App\Helper\HTTP\Request\Request;

interface FactoryInterface
{
    public static function make(string $queryString = '', string $method =''):Request;
}
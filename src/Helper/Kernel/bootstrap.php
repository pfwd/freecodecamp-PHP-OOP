<?php
use App\Helper\HTTP\Route\Factory;
use App\Helper\HTTP\Validation\Validation;
use App\Helper\HTTP\Validation\Type;
use App\Helper\HTTP\Route\Validator;

$routeData = require_once BASE_PATH.'app/config/routing.php';

// Make Route Validation
$validation = new Validation();
$validation->setValidators([
    new Type\PatternValidator(),
    new Type\ControllerValidator(),
    new Type\ActionValidator()
]);

// Make routes
$routeFactory = new Factory();
$routes = $routeFactory->makeRoutes($routeData);
Validator::validate($routes, $validation);

return $routes;

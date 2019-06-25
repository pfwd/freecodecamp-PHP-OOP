<?php
use App\Helper\HTTP\Route\Factory;
use App\Helper\HTTP\Validation\Validation;
use App\Helper\HTTP\Validation\Type;
use App\Helper\HTTP\Route\Validator;

require_once 'config.php';
require_once BASE_PATH.'vendor/autoload.php';
$routeData = require_once CONFIG_PATH.'routing.php';

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

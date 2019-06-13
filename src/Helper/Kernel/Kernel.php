<?php
use App\Helper\Route\Processor;

$basePath = $_SERVER['DOCUMENT_ROOT'] . '/../';
require $basePath.'../vendor/autoload.php';
$routes = $basePath.'app/routes.php';

$processor = new Processor();
$router = $processor->make($routes);
return $processor->run($router, $_SERVER['REQUEST_URI']);

// $view = View::run($currentURI)
<?php
use Helper\Route\Processor;

$basePath = $_SERVER['DOCUMENT_ROOT'] . '/../';
require_once $basePath . 'src/Helper/AutoLoader/AutoLoader.php';
$routes = require_once $basePath .'app/config/routing.php';

$currentURI = '/';

$processor = new Processor();
$router = $processor->make($routes);
return $processor->process($router, '/');

// $view = View::run($currentURI)
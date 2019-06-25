<?php
use App\Helper\Kernel\Kernel;

$routes = require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/config/bootstrap.php';

try {
    $response = Kernel::boot($routes);
} catch (Exception $exception) {
    if($exception->getCode() === 404) {
        header("HTTP/1.0 404 Not Found");
        exit;
    }
}






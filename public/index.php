<?php
use App\Helper\Kernel\Kernel;

require_once '../app/config/config.php';
require BASE_PATH.'vendor/autoload.php';
$routes = require_once KERNEL_PATH.'bootstrap.php';

try {
    $response = Kernel::boot($routes);
    require_once PUBLIC_PATH.$response['view'];

} catch (Exception $exception) {
    if($exception->getCode() === 404) {
        header("HTTP/1.0 404 Not Found");
        exit;
    }
}






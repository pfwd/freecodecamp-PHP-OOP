<?php

use App\Controller\Type;

return [
    [
        'pattern' => '/',
        'controller' => Type\Home::class,
        'method' => ['GET'],
        'action' => 'index'
    ],
    [
        'pattern' => '/invoice/([0-9]*)',
        'controller' => Type\Invoice::class,
        'method' => ['GET'],
        'action' => 'index'
    ],
    [
        'pattern' => '/invoice/([0-9]*)/edit/([0-9]*)',
        'controller' => Type\Invoice::class,
        'method' => ['GET'],
        'action' => 'index'
    ],
];
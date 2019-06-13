<?php

use Controller\Type;

return [
    [
        'pattern' => '/',
        'controller' => Type\Home::class,
        'method' => 'index',
    ],
    [
        'pattern' => '/invoice/([0-9]*)',
        'controller' => Type\Invoice::class,
        'method' => 'index'
    ],
    [
        'pattern' => '/invoice/([0-9]*)/edit/([0-9]*)',
        'controller' => Type\Invoice::class,
        'method' => 'index'
    ],
];
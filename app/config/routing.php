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
        'pattern' => '/invoice',
        'controller' => Type\Invoice::class,
        'method' => ['GET'],
        'action' => 'dashboard'
    ],
    [
        'pattern' => '/invoice/{id}',
        'controller' => Type\Invoice::class,
        'method' => ['GET'],
        'action' => 'index',
        'parameters' => [
            'id' => '([0-9]*)'
        ]
    ],
    [
        'pattern' => '/invoice/([0-9]*)/edit',
        'controller' => Type\Invoice::class,
        'method' => ['GET'],
        'action' => 'edit'
    ],
];
<?php

use App\Controller;

return [
    [
        'pattern' => '/',
        'controller' => Controller\Home::class,
        'method' => ['GET'],
        'action' => 'index'
    ],
    [
        'pattern' => '/invoice',
        'controller' => Controller\Invoice::class,
        'method' => ['GET'],
        'action' => 'dashboard'
    ],
    [
        'pattern' => '/invoice/{id}',
        'controller' => Controller\Invoice::class,
        'method' => ['GET'],
        'action' => 'index',
        'parameters' => [
            'id' => '([0-9]*)'
        ]
    ],
    [
        'pattern' => '/invoice/{id}/edit',
        'controller' => Controller\Invoice::class,
        'method' => ['GET'],
        'action' => 'edit',
        'parameters' => [
            'id' => '([0-9]*)'
        ]
    ],
];
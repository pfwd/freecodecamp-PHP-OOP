<?php
namespace Controller\Type;

use Controller\AbstractController;

class Home extends AbstractController
{
    public function index()
    {
        return [
            'view' => 'views/home.php',
            'params' => []
        ];
    }

    public function list()
    {
        return [
            'view' => 'views/list.php',
            'params' => []
        ];
    }
}
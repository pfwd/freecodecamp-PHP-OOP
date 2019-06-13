<?php
namespace App\Controller\Type;

use App\Controller\AbstractController;

class Invoice extends AbstractController
{
    public function index()
    {
        return [
            'view' => 'views/invoice.php',
            'params' => []
        ];
    }

}
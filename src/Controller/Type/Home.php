<?php
namespace App\Controller\Type;

use App\Controller\AbstractController;
use App\Helper\HTTP\Request\Request;
use App\Helper\HTTP\Response\View;

class Home extends AbstractController
{
    public function index(Request $request)
    {
        return View::render('views/home/index.php');
    }
}
<?php
namespace App\Controller;

use App\Helper\HTTP\Request\Request;
use App\Helper\HTTP\Response\View;

class Invoice extends AbstractController
{
    public function index(Request $request)
    {
        return View::render('views/invoice/index.php',[
                'id' => $request->getParameter('id')
            ]
        );
    }

    public function edit(Request $request)
    {
        return View::render('views/invoice/edit.php',[
                'id' => $request->getParameter('id')
            ]
        );
    }

    public function dashboard(Request $request)
    {
        return View::render('views/invoice/dashboard.php');
    }
}
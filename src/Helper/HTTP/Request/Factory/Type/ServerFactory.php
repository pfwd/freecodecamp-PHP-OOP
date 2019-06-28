<?php
namespace App\Helper\HTTP\Request\Factory\Type;
use App\Helper\HTTP\Request\Factory\FactoryInterface;
use App\Helper\HTTP\Request\Request;
use Exception;

class ServerFactory implements FactoryInterface
{
    /**
     * @param string $queryString
     * @param string $method
     *
     * @return Request
     *
     * @throws Exception
     */
    public static function  make(string $queryString = '', string $method = ''): Request
    {
        $request = new Request($queryString, $method);
        if(!isset($_SERVER['REQUEST_URI'])) {
            throw new Exception('REQUEST_URI not found');
        }

        if(!isset($_SERVER['REQUEST_METHOD'])) {
            throw new Exception('REQUEST_METHOD not found');
        }
        $request->setPath($_SERVER['REQUEST_URI']);
        $request->setMethod($_SERVER['REQUEST_METHOD']);

        return $request;

    }

}
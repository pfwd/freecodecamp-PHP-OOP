<?php
namespace Helper\HTTP\Request;

use App\Helper\HTTP\Request\Factory\Type\ServerFactory;
use App\Helper\HTTP\Request\Request;
use Exception;

class ServerFactoryTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @group request
     * @group request-server-factory
     */
    public function testDefault()
    {
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $factory = new ServerFactory();
        $request = $factory::make();

        $this->assertInstanceOf(Request::class, $request);
    }

    /**
     * @group request
     * @group request-server-factory-uri-exception
     */
    public function testURIException()
    {
        $this->tester->expectException(new Exception("REQUEST_URI not found"), function() {
            $_SERVER['REQUEST_METHOD'] = 'GET';

            $factory = new ServerFactory();
            $factory::make();
        });

    }

    /**
     * @group request
     * @group request-server-factory-method-exception
     */
    public function testMethodException()
    {
        $this->tester->expectException(new Exception("REQUEST_METHOD not found"), function() {
            $_SERVER['REQUEST_URI'] = '/';

            $factory = new ServerFactory();
            $factory::make();
        });

    }

}
<?php
namespace Helper\HTTP\Request;

use App\Helper\HTTP\Request\Request;

class RequestTest extends \Codeception\Test\Unit
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
     * @group request-default
     */
    public function testDefault()
    {
        $route = new Request();

        $this->assertEmpty($route->getPath());
        $this->assertEmpty($route->getMethod());

    }

    /**
     * @group request
     * @group request-set-URI-in-constructor
     */
    public function testSetURIInConstructor()
    {
        $route = new Request('/');

        $this->assertSame('/', $route->getPath());

    }

    /**
     * @group request
     * @group request-set-URI
     */
    public function testSetURI()
    {
        $route = new Request();

        $route->setPath('/');

        $this->assertSame('/', $route->getPath());

    }

    /**
     * @group request
     * @group request-set-method-in-constructor
     */
    public function testSetMethodInConstructor()
    {
        $route = new Request('/', 'GET');

        $this->assertSame('GET', $route->getMethod());

    }

    /**
     * @group request
     * @group request-set-method
     */
    public function testSetMethod()
    {
        $route = new Request();

        $route->setMethod('GET');

        $this->assertSame('GET', $route->getMethod());

    }

    /**
     * @group request
     * @group request-set-method
     */
    public function testSetLowerCaseMethod()
    {
        $route = new Request();

        $route->setMethod('get');

        $this->assertSame('GET', $route->getMethod());

    }
}
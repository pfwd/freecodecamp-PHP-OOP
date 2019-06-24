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
        $this->assertEmpty($route->getParameters());
        $this->assertIsArray($route->getParameters());
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

    /**
     * @group request
     * @group request-add-parameter
     */
    public function testAddParameter()
    {
        $route = new Request();

        $route->addParameter('id', 123);

        $this->assertSame(123, $route->getParameter('id'));

    }

    /**
     * @group request
     * @group request-add-parameter
     */
    public function testSetParameters()
    {
        $route = new Request();

        $route->setParameters([
            'id' => 123
        ]);

        $this->assertArrayHasKey('id', $route->getParameters());

    }

    /**
     * @group request
     * @group request-add-parameter
     */
    public function testGetDefaultParameter()
    {
        $route = new Request();

        $this->assertSame(345, $route->getParameter('id', 345));

    }

    /**
     * @group request
     * @group request-add-parameter
     */
    public function testGetNullParameter()
    {
        $route = new Request();

        $this->assertNull($route->getParameter('id'));

    }
}
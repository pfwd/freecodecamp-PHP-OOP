<?php
namespace Helper\HTTP\Route;

use App\Controller\Type\Home;
use App\Helper\HTTP\Route\Route;
use App\Helper\HTTP\Route\Router;

class RouterTest extends \Codeception\Test\Unit
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
     * @group router
     * @group router-defaults
     */
    public function testDefaults()
    {
        $router = new Router();
        $this->assertIsArray($router->getRoutes());
        $this->assertEquals(0, count($router->getRoutes()));
    }

    /**
     * @group router
     * @group router-routes-array
     */
    public function testIsRoutesAnArray()
    {
        $router = new Router();
        $this->assertIsArray($router->getRoutes());
    }

    /**
     * @group router
     * @group router-add-route
     */
    public function testAddRoute()
    {
        $route = new Route();
        $route->setController(Home::class)
            ->setMethods(['GET'])
            ->setPattern('/')
            ->setAction('index')
        ;

        $router = new Router();
        $router::add($route);

        $this->assertIsArray($router->getRoutes());
        $this->assertEquals(1, count($router->getRoutes()));
    }

    /**
     * @group router
     * @group router-add-duplicate
     */
    public function testAddDuplicateRoute()
    {
        $route = new Route();
        $route->setController(Home::class)
            ->setMethods(['GET'])
            ->setPattern('/')
            ->setAction('index')
        ;

        $router = new Router();
        $router::add($route);
        $router::add($route);

        $this->assertIsArray($router->getRoutes());
        $this->assertEquals(1, count($router->getRoutes()));
    }
}
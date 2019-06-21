<?php
namespace Helper\HTTP\Locator;


use App\Helper\HTTP\Locator\Locator;
use App\Helper\HTTP\Request\Request;
use App\Helper\HTTP\Route\Route;

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
     * @group locator
     * @group locator-default
     */
    public function testDefault()
    {
        $request = new Request('/', 'GET');
        $locator = new Locator($request);

        $this->assertNull($locator->locate());

    }

    /**
     * @group locator
     * @group locator-valid-route
     */
    public function testInvoiceID()
    {
        $route = new Route();
        $route->setPattern('/invoice/([0-9]*)')
            ->setMethods(['GET'])
            ;
        $request = new Request('/invoice/123', 'GET');
        $locator = new Locator($request, [$route]);

        $this->assertInstanceOf(Route::class, $locator->locate());

    }

    /**
     * @group locator
     * @group locator-valid-route
     */
    public function testInvoiceEdit()
    {
        $route = new Route();
        $route->setPattern('/invoice/([0-9]*)/edit')
            ->setMethods(['GET'])
        ;
        $request = new Request('/invoice/123/edit', 'GET');
        $locator = new Locator($request, [$route]);

        $this->assertInstanceOf(Route::class, $locator->locate());

    }

    /**
     * @group locator
     * @group locator-invoice-item-edit
     */
    public function testInvoiceItemEdit()
    {
        $route1 = new Route();
        $route1->setPattern('/invoice/([0-9]*)/item/([0-9]*)/edit')
            ->setMethods(['GET'])
        ;
        $route2 = new Route();
        $route2->setPattern('/invoice/([0-9]*)/item/([0-9]*)/not-valid')
            ->setMethods(['GET'])
        ;
        $request = new Request('/invoice/123/item/456/edit', 'GET');
        $locator = new Locator($request, [$route1, $route2]);

        $foundRoute = $locator->locate();

        $this->assertInstanceOf(Route::class, $foundRoute);
        $this->assertSame('/invoice/([0-9]*)/item/([0-9]*)/edit', $foundRoute->getPattern());

    }

    /**
     * @group locator
     * @group locator-pattern-create
     */
    public function testPatternCreate()
    {

        $route = new Route();
        $route->setPattern('/invoice/([0-9]*)');
        $pattern = Locator::createPattern($route);

        $this->assertSame('#^/invoice/([0-9]*)$#',$pattern);

    }

}
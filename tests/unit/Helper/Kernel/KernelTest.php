<?php
namespace Helper\Kernel;

use App\Helper\HTTP\Locator\Locator;
use App\Helper\HTTP\Locator\URIPatternBuilder;
use App\Helper\HTTP\Request\Request;
use App\Helper\HTTP\Route\Route;
use App\Helper\Kernel\Kernel;

class KernelTest extends \Codeception\Test\Unit
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
        $booted = Kernel::boot([]);

        $this->asser($booted);

    }



}
<?php
namespace Helper\HTTP\URI;

use App\Controller\Type;
use App\Helper\HTTP\Route\Factory;
use App\Helper\HTTP\Route\Route;
use App\Helper\HTTP\URI\URIBuilder;

class URIBuilderTest extends \Codeception\Test\Unit
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
     * @group uri
     * @group uri-blank-default
     */
    public function testBlankDefault()
    {
        $uri = URIBuilder::build('');

        $this->assertSame('#^$#', $uri);
    }

    /**
     * @group uri
     * @group uri-blank-default-with-array
     */
    public function testBlankDefaultWithArray()
    {
        $uri = URIBuilder::build('',['id' => 123]);

        $this->assertSame('#^$#', $uri);
    }

    /**
     * @group uri
     * @group uri-place-holder
     */
    public function testPlaceHolder()
    {
        $uri = URIBuilder::build('/{foo_bar}', ['foo_bar' => 'abc']);

        $this->assertSame('#^/abc$#', $uri);
    }

    /**
     * @group uri
     * @group uri-broken-place-holder
     */
    public function testBrokenPlaceHolder()
    {
        $uri = URIBuilder::build('/{foo_', ['foo' => 'abc']);

        $this->assertSame('#^/{foo_$#', $uri);
    }
}
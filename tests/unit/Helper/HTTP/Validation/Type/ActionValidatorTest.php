<?php
namespace Helper\HTTP\Validation;

use App\Controller\Home;
use App\Helper\HTTP\Route\Route;
use App\Helper\HTTP\Validation\Type\ActionValidator;

class ActionValidatorTest extends \Codeception\Test\Unit
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
     * @group validation
     * @group validation-type
     * @group validation-type-action
     * @group validation-type-action-does-exist
     */
    public function testDoesActionExist()
    {
        $validator = new ActionValidator();
        $this->assertTrue($validator->doesExist(Home::class, 'index'));
    }

    /**
     * @group validation
     * @group validation-type
     * @group validation-type-action
     * @group validation-type-action-does-not-exist
     */
    public function testDoesNotActionExist()
    {
        $validator = new ActionValidator();
        $this->assertFalse($validator->doesExist(Home::class, 'NOT_FOUND'));
    }

    /**
     * @group validation
     * @group validation-type
     * @group validation-type-action
     * @group validation-type-action-is-in-valid
     */
    public function testIsInValid()
    {
        $route = new Route();

        $validator = new ActionValidator();
        $validator->setRoute($route);
        $this->assertFalse($validator->isValid());
    }

    /**
     * @group validation
     * @group validation-type
     * @group validation-type-action
     * @group validation-type-action-is-valid
     */
    public function testIsValid()
    {
        $route = new Route();
        $route->setController(Home::class);
        $route->setAction('index');

        $validator = new ActionValidator();
        $validator->setRoute($route);
        $this->assertTrue($validator->isValid());
    }
}
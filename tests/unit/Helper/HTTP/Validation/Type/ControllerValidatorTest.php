<?php
namespace Helper\HTTP\Validation;

use App\Controller\Home;
use App\Helper\HTTP\Route\Route;
use App\Helper\HTTP\Validation\Type\ControllerValidator;


class ControllerValidatorTest extends \Codeception\Test\Unit
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
     * @group validation-type-controller
     * @group validation-type-controller-does-exist
     */
    public function testDoesControllerExist()
    {
        $validator = new ControllerValidator();
        $this->assertTrue($validator->doesExist(Home::class));
    }

    /**
     * @group validation
     * @group validation-type
     * @group validation-type-controller
     * @group validation-type-controller-does-not-exist
     */
    public function testDoesNotControllerExist()
    {
        $validator = new ControllerValidator();
        $this->assertFalse($validator->doesExist('NOT_FOUND'));
    }

    /**
     * @group validation
     * @group validation-type
     * @group validation-type-controller
     * @group validation-type-controller-empty
     */
    public function testDoesNotControllerEmpty()
    {
        $route = new Route();

        $validator = new ControllerValidator();
        $validator->setRoute($route);
        $this->assertFalse($validator->isValid());
    }

    /**
     * @group validation
     * @group validation-type
     * @group validation-type-controller
     * @group validation-type-controller-set
     */
    public function testDoesNotControllerSet()
    {
        $route = new Route();
        $route->setController(Home::class);

        $validator = new ControllerValidator();
        $validator->setRoute($route);
        $this->assertTrue($validator->isValid());
    }
}
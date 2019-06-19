<?php
namespace Helper\HTTP\Validation;

use App\Helper\HTTP\Validation\Type\ControllerValidator;
use App\Helper\HTTP\Validation\Type\MethodValidator;
use App\Helper\HTTP\Validation\Validation;

class ValidationTest extends \Codeception\Test\Unit
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
     * @group validation-add-one-validator
     */
    public function testValidationAddOne()
    {

        $validator = new ControllerValidator();

        $validation = new Validation();
        $validation->addValidator($validator);

        $this->assertTrue($validation->hasValidator(ControllerValidator::class));

    }

    /**
     * @group validation
     * @group validation-add-two-validator
     */
    public function testValidationAddTwo()
    {
        $validator1 = new ControllerValidator();
        $validator2 = new MethodValidator();

        $validation = new Validation();
        $validation->addValidator($validator1);
        $validation->addValidator($validator2);

        $this->assertTrue($validation->hasValidator(ControllerValidator::class));
        $this->assertTrue($validation->hasValidator(MethodValidator::class));

    }

}
<?php
namespace App\Helper\HTTP\Validation;

use App\Helper\HTTP\Route\Route;

class Validation
{
    /**
     * @var array
     */
    private $validators = [];

    /**
     * @param array $validators
     */
    public function setValidators(array $validators)
    {
        foreach($validators as $validator) {
            $this->validators[get_class($validator)] = $validator;
        }
    }

    /**
     * @param InterfaceValidator $interfaceValidation
     */
    public function addValidator(InterfaceValidator $interfaceValidation)
    {
        $this->setValidators([$interfaceValidation]);
    }

    /**
     * @param string $className
     *
     * @return bool
     */
    public function hasValidator($className):bool
    {
        return key_exists($className, $this->validators);
    }

    /**
     * @param Route $route
     *
     * @return bool
     */
    public function validate(Route $route):bool
    {
        $isValid = false;

        foreach($this->validators as $validator) {
            if($validator instanceof InterfaceValidator) {
                $validator->setRoute($route);
                $isValid = $validator->isValid();

                if(false === $isValid) {
                    break;
                }
            }
        }

        return $isValid;
    }
}
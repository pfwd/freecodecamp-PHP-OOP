<?php
namespace App\Helper\Route\Validation\Type;

use App\Helper\Route\Validation\InterfaceValidator;
use ReflectionClass;
use ReflectionException;

use App\Helper\Route\Validation\AbstractType;

class ControllerValidator extends AbstractType implements InterfaceValidator
{
    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $isValid = false;
        $className = $this->route->getController();

        if(false === empty($className)) {
            $isValid = $this->doesExist($className);
        }

        return $isValid;
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public function doesExist(string $string): bool
    {
        $isValid = true;
        try {
            new ReflectionClass($string);
        } catch (ReflectionException $exception){
            $isValid = false;
        }
        return $isValid;

    }

}
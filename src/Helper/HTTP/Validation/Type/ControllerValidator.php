<?php
namespace App\Helper\HTTP\Validation\Type;

use App\Helper\HTTP\Validation\InterfaceValidator;
use App\Helper\HTTP\Validation\AbstractType;
use ReflectionClass;
use ReflectionException;


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
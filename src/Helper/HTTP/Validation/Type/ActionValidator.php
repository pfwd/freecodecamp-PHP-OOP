<?php
namespace App\Helper\HTTP\Validation\Type;

use App\Helper\HTTP\Validation\AbstractType;
use App\Helper\HTTP\Validation\InterfaceValidator;
use ReflectionMethod;
use ReflectionException;

class ActionValidator extends AbstractType implements InterfaceValidator
{
    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $className = $this->route->getController();
        $actionName = $this->route->getAction();

        $isValid = false;
        if(false === empty($actionName) && false === empty($className)) {
            $isValid = $this->doesExist($className, $actionName);
        }

        return $isValid;
    }

    /**
     * @param string $className
     * @param string $actionName
     *
     * @return bool
     */
    public function doesExist(string $className, string $actionName):bool
    {
        $isValid = true;
        try {
            new ReflectionMethod($className, $actionName);
        } catch (ReflectionException $exception){
            $isValid = false;
        }

        return $isValid;
    }

}
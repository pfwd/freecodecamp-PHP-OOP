<?php
namespace App\Helper\Route\Validation\Type;
use App\Helper\Route\Validation\AbstractType;
use App\Helper\Route\Validation\InterfaceValidator;

class PatternValidator extends AbstractType implements InterfaceValidator
{
    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return !empty($this->route->getPattern());
    }


}
<?php
namespace App\Helper\HTTP\Validation\Type;
use App\Helper\HTTP\Validation\AbstractType;
use App\Helper\HTTP\Validation\InterfaceValidator;

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
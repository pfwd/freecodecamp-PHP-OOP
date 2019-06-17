<?php
namespace App\Helper\Route\Validation\Type;
use App\Helper\Route\Validation\AbstractType;
use App\Helper\Route\Validation\InterfaceValidator;

class MethodValidator extends AbstractType implements InterfaceValidator
{
    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $isValid = false;

        $value = $this->route->getMethods();

        if(is_array($value)) {
            $isValid = $this->isValueCorrect($value);
        }

        return $isValid;
    }

    /**
     * @param array $values
     *
     * @return bool
     */
    public function isValueCorrect(array $values)
    {
        $possible = [
            'GET',
            'POST'
        ];

        foreach($values as $value) {
            if(false === in_array($value, $possible)) {
                return false;
            }
        }

        return true;
    }



}
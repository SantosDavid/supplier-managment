<?php

namespace App\Validations;

use Illuminate\Contracts\Validation\Rule;

class PrefixValidationRule implements Rule
{
    protected $permited = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'z',
    ];

    public function passes($attribute, $value)
    {
        for ($i = 0; $i < strlen($value); $i++) {
            
            if (!in_array($value[$i], $this->permited)) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return ':attribute só pode ter letras minusculas!';
    }
}

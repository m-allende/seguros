<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IdentificatorRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $rut = preg_replace('/[^k0-9]/i', '', $value);
        $dv  = substr($rut, -1);
        $numero = substr($rut, 0, strlen($rut)-1);
        if(!(preg_match('/\d/', $numero) === 1)){
            return false;
        }
        $i = 2;
        $suma = 0;
        foreach(array_reverse(str_split($numero)) as $v)
        {
            if($i==8)
                $i = 2;

            $suma += $v * $i;
            ++$i;
        }

        $dvr = 11 - ($suma % 11);

        if($dvr == 11)
            $dvr = 0;
        if($dvr == 10)
            $dvr = 'K';

        if($dvr == strtoupper($dv))
            return true;
        else
            return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Rut con error (use formato 99999999-9)';
    }
}

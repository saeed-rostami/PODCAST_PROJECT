<?php

namespace Modules\OTP\Rules;

use Illuminate\Contracts\Validation\Rule;

class MobileRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes( $attribute , $value )
    {
        $re = '/^(989|09|9|0989)[0-9]{9}$/';
        if ( preg_match( $re , $value , $matches , PREG_OFFSET_CAPTURE , 0 ) && is_numeric( $value ) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'شماره همراه معتبر نیست';
    }
}

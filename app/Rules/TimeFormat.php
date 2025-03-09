<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class TimeFormat implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^(?:[01]?\d|2[0-3]):[0-5]\d(:[0-5]\d)?$/', $value);
    }

    public function message()
    {
        return 'The :attribute must be a valid time format (HH:mm or HH:mm:ss).';
    }
}

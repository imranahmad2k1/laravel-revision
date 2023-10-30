<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaskedPhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phone_no = $value;
        $cleanedPhoneNo = preg_replace('/\D/', '', $phone_no);

        if(strlen($cleanedPhoneNo) != 11){
            $fail('The :attribute must be an 11 digits number.');
        }
        
    }
}

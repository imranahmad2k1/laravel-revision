<?php

namespace App\Helpers;

class PhoneNumbers{
    public static function formatPhoneNumber($phone){
        $ac = substr($phone, 0, 4); // 1234
        $suffix = substr($phone, 4);

        return "{$ac}-{$suffix}";
    }
}
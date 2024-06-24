<?php

namespace Framework;

class Valadation
{

    /**
     * Check if a value is a string and has a minimum and maximum length
     */
    public static function string($value, $min = 1, $max = INF)
    {
        if (is_string($value)) {
            $value = trim($value);
            $length = strlen($value);
            return $length >= $min && $length <= $max;
        }
        return false;
    }

    //Check of het een geldige e-mail is
    public  static function email($value)
    {
        $value =  trim($value);
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    //Check of  2 values  gelijk zijn aan elkaar
    public static function match($valueOne, $valueTwo)
    {
        $valueOne = trim($valueOne);
        $valueTwo = trim($valueTwo);

        return $valueOne === $valueTwo;
    }
}

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


    public  static function email($value)
    {
        $value =  trim($value);
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function match($valueOne, $valueTwo)
    {
        $valueOne = trim($valueOne);
        $valueTwo = trim($valueTwo);

        return $valueOne === $valueTwo;
    }


    public static function numeric($value, $min = null, $max = null)
    {
        $value = trim($value);
        if (!is_numeric($value)) {
            return false;
        }
        if ($min !== null && $value < $min || $value > $max) {
            return false;
        }
        return true;
    }

    public static function integerLength($value, $length)
    {
        $value = trim($value);
        if (is_int($value) || ctype_digit($value)) {
            return strlen((string)$value) === $length;
        }
        return false;
    }
}

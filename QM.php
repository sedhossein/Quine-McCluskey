<?php

class QM
{
    protected $VARIABLES;
    

    public function __construct($variables_count)
    {
        $this->VARIABLES = $variables_count;
    }


    public function fill_letters_in_array()
    {
        $letters = ["a", "b", "c", "d", "e", "f", "g", "h"];
        $array = [];

        for ($index = 0; $index < $this->VARIABLES; $index++)
            $array[] = $letters[$index];

        return $array;
    }

    public function decimal_to_binary($number)
    {
        if ($number == 0 || $number == 1)
            return $number . "";

        if ($number % 2 == 0)
            return self::decimal_to_binary($number / 2) . "0";
        else
            return self::decimal_to_binary($number / 2) . "1";
    }


    public function pad($binary)
    {
        $max = $this->VARIABLES - strlen($binary);

        for ($index = 0; $index < $max; $index++)
            $binary = "0" . $binary;

        return $binary;
    }

    public static function count($array, $target_number)
    {
        $counter = 0;

        for ($index = 0; $index != strlen($array); $index++)
            if ($array[$index] == $target_number)
                $counter++;


        return $counter;
    }

    public static function is_gary($number1, $number2)//differs_in_one_bit
    {
        $match = false; //flag

        for ($index = 0; $index != strlen($number1); $index++) {
            if ($number1[$index] != $number2[$index]) {
                if ( ! $match) {
                    $match = true;
                } else
                    return false;
            }
        }
        return true;
    }


    //function to replace complement terms with don't cares to reduce minterms
    // Eg: 0110 and 0111 becomes 011-
    public static function simplify($number1, $number2)
    {
        if ( ! self::is_gary($number1, $number2))
            return false;

        for ($index = 0; $index != strlen($number1); $index++) {
            if ($number1[$index] != $number2[$index]) {
                $number1[$index] = '-';
                return $number1;
            }
        }
        return 'NULL';
    }

    public function in_array($array,$target)
    {
        for ($index = 0; $index < array_count_values($array); $index++)
            if ( $array[$index] == $target)
                return true;

        return false;
    }



}


?>


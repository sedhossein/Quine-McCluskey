<?php

class QM
{
    protected $_variable_count;
    protected $_do_not_cares;


    public function __construct($variables_count)
    {
        $this->_variable_count = $variables_count;
    }


    protected function fill_letters_in_array()
    {
        $letters = ["a", "b", "c", "d", "e", "f", "g", "h"];
        $array = [];

        for ($index = 0; $index < $this->_variable_count; $index++)
            $array[] = $letters[$index];

        return $array;
    }

    public function pad($binary)
    {
        $max = $this->_variable_count - strlen($binary);

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

    public static function is_gray($number1, $number2)//differs_in_one_bit
    {
        $flag = 0;

        for ($i = 0; $i < strlen($number1); $i++)
            if ($number1[$i] != $number2[$i])
                $flag++;

        return ($flag == 1);
    }


    //function to replace complement terms with don't cares to reduce minterms
    // Eg: 0110 and 0111 becomes 011-
    public static function simplify($number1, $number2)
    {
        if ( ! self::is_gray($number1, $number2))
            return false;

        for ($index = 0; $index != strlen($number1); $index++) {
            if ($number1[$index] != $number2[$index]) {
                $number1[$index] = '-';
                return $number1;
            }
        }
        return 'NULL';
    }

//    public static function my_in_array($array, $target) //test
//    {
//        print_r($array);
//        die();
//
//        for ($index = 0; $index < count($array); $index++)
//            if ($array[$index] == $target)
//                return true;
//
//        return false;
//    }

    public function getValue($a)
    {
        $temp = "";
        $vars = $this->fill_letters_in_array();

        if ($a == $this->_do_not_cares)
            return "1";

        for ($i = 0; $i < strlen($a); $i++) {
            if ($a[$i] != '-') {
                if ($a[$i] == '0')
                    $temp = $temp . $vars[$i] . "'";
                else
                    $temp = $temp . $vars[$i];
            }
        }
        return $temp;
    }

}

function replace_complements($aa, $bb)
{
    $temp = "";
    $a = strval($aa) . "";
    $b = (string)$bb . "";
//    print strlen($a);
//    die();
    for ($i = 0; $i < strlen($a); $i++) {
        if ($a[$i] != $b[$i])
            $temp .= "-";
        else
            $temp .= $a[$i];
    }


    return $temp;
}

function array_equal($a, $b)
{
    return (
        is_array($a)
        && is_array($b)
        && count($a) == count($b)
        && array_diff($a, $b) === array_diff($b, $a)
    );
}


function reduce($minterms) // minterms is an array
{
    $new_minterms = [];
    $max = count($minterms);
    $checked = []; //length == max

    for ($i = 0; $i < $max; $i++)
        $checked[$i] = 0;


    for ($i = 0; $i < $max; $i++) {
        for ($j = $i + 1; $j < $max; $j++) {
            //If a grey code pair is found, replace the differing bits with don't cares.
            if (QM::is_gray($minterms[$i], $minterms[$j])) {

                $checked[$i] = true;
                $checked[$j] = true;

                if ( ! in_array(replace_complements($minterms[$i], $minterms[$j]), $new_minterms)) {
                    $new_minterms[] = replace_complements($minterms[$i], $minterms[$j]);
                }
            }
        }
    }

    //appending all reduced terms to a new vector


    for ($i = 0; $i < $max; $i++){
//        print $minterms[$i] . " = ";
        if ($checked[$i] != 1 && ! in_array($minterms[$i], $new_minterms)){
            $new_minterms[] = $minterms[$i];
        }

    }


    return $new_minterms;
}

?>


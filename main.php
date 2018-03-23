<?php

include 'QM.php';
$array = [1, 1, 1, 0, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1];
$ones = [];


echo "<hr>";

$qm = new QM($number_of_variables);


function make_group($packet, $temp_array)
{
    for ($index = 1; $index != count($packet); $index++) { // iterate the packet

        echo 'Groupings for ' . $index . ',' . ($index + 1) . "<br>";

        foreach ($packet[$index] as $key_one => $one) {

            $matched = false;

            foreach ($packet[$index + 1] as $key_two => $two) {

                if (QM::is_gary($one, $two)) {

                    $matched = true;
                    echo '(' . $key_one . ',' . $key_two . ') ' . QM::simplify($one, $two) . "<br>";
                    $temp_array[$index][$key_one . ';' . $key_two] = QM::simplify($one, $two);

                }

            }

            if ( ! $matched) {
                $output[$key_one] = $one;
            }
        }
    }
    return $temp_array;
}

foreach ($array as $key => $value) {

    $temp = $key; //retain decimal
    $key = decbin($key);//get binary vwxyz

    while (strlen($key) != 5) {
        $key = '0' . $key;
    }

    if ($value == 1)
        $ones[$temp] = $key;

}

$packet = [];

for ($index = 1; $index != 8; $index++) {

    $packet[$index] = [];
    echo 'Number of indexes: ' . $index . "<br>";

    foreach ($ones as $key => $value) {
        if (QM::count($value, 1) == $index) {
            echo 'Index: ' . $key . '; Minterms: ' . $value . "<br>" . PHP_EOL;
            $packet[$index][$key] = $value;
        }
    }
}

for ($it = 1; count($packet) != 1; $it++) {

    echo '========ITERATION-' . $it . '==========' . "<br>";

    $output = [];//minterms that cannot be matched are placed here - our answer
    $temp_array = [];//next packet

    $temp_array = make_group($packet, $temp_array);

    echo 'UNMATCHED OUTPUTS: ' . "<br>";
    foreach ($output as $k => $v) {
        echo $k . ': ' . $v . "<br>";
    }
    $packet = $temp_array;
}
?>

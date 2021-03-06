<?php

include "QM.php";
echo "<hr>";


$qm = new QM($number_of_variables);

$minterms = [];

//  ===============================   MAIN LOGIC   ===============================

foreach ($array_of_minterms as $minterm) {
    $minterms[] = $qm->pad(decbin($minterm));
}

sort($minterms);


do {
    $minterms = reduce($minterms);
} while ( !array_equal($minterms, reduce($minterms) ));



echo "The reduced boolean expression in SOP form: <br>";
for ($i = 0; $i < count($minterms)-1; $i++)
    echo $qm->getValue($minterms[$i]) . "+";

    echo $qm->getValue($minterms[$i]);

?>

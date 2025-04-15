<?php
function replace_for_n($tablica, $n){
    if (!is_int($n) || $n < 0 || $n > count($tablica)) {
        echo "BLAD";
        return 0;
    }
    array_splice($tablica, $n, 0, '$');
    return $tablica;
}

$tablica = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$n = 4;
$result = replace_for_n($tablica, $n);
print_r($result);

?>


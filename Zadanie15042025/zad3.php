<?php
    $a = 1;
    $b = 2;
    $c = 3;
    $d = 4;
    $tablica = [];
    function createTablica($a, $b, $c, $d){
        if ($a > $b || $c > $d) {
            echo "Blad";
            return;
        }

    }

    for ($i = $a, $j = $c; $i <= $b && $j <= $d; $i++, $j++) {
        $tablica[$i] = $j;
    }
    print_r($tablica);

?>

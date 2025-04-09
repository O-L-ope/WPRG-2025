<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--    <script> function reloadPage() { location.reload(); } </script>-->
</head>
<body>
    <form action="" method="POST">
        <div>
            <input type="number" step="any" name="a">
        </div>
        <div>
            <input type="number" step="any" name="b">
        </div>
        <div>
            <input type="number" step="any" name="c">
        </div>
        <div>
            <input type="submit" name="submit" value="oblicz">
        </div>
        <!--        <div>-->
        <!--            <input type="button" value="Reload page" onclick="reloadPage()">-->
        <!--        </div>-->
    </form>
<?php
//function ciagi($pierwszy_wyraz, $roznica, $liczba_elementow) {
//
//    $ciag_arytmetyczny=$liczba_elementow/2

function ciagi($pierwszy_wyraz, $roznica, $liczba_elementow) {
    $ciag_arytmetyczny = [];
    for ($i = 0; $i < $liczba_elementow; $i++) {
        $ciag_arytmetyczny[] = $pierwszy_wyraz + $i * $roznica;
    }

    $ciag_geometryczny = [];
    for ($i = 0; $i < $liczba_elementow; $i++) {
        $ciag_geometryczny[] = $pierwszy_wyraz * pow($roznica, $i);
    }

    echo "<p>Arithmetic: ";
    foreach ($ciag_arytmetyczny as $element) {
        echo "$element ";
    }
    echo "</p>";

    echo "<p>Geometric: ";
    foreach ($ciag_geometryczny as $element) {
        echo "$element ";
    }
    echo "</p>";
    $suma_arytmetycznego = array_sum($ciag_arytmetyczny);
    $suma_geometrycznego = array_sum($ciag_geometryczny);
    echo "<p>Suma ciagu arytmetycznego: $suma_arytmetycznego</p>";
    echo "<p>Suma ciagu geometrycznego: $suma_geometrycznego</p>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pierwszy_wyraz = (float) $_POST["a"];
    $roznica = (float) $_POST["b"];
    $liczba_elementow = (int) $_POST["c"];
    if(isset($_POST["submit"])){
        if($_POST["c"] < 0){
            echo "<p>liczba elementow ciagu nie moze byc ujemna</p>";
    }
    ciagi($pierwszy_wyraz, $roznica, $liczba_elementow);
}
}
?>
</body>
</html>

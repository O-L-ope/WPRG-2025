<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        margin 0;
        background-color: lightslategray;
    }

</style>


<body>
    <h1>
        Kalkulator
    </h1>
    <hr>
    <form method="POST" action="">
        <h3>Prosty</h3>
        <input type="number" name="a">
        <select name="funkcje" id="funkcje_matematyczne">
            <option value="dodawanie">Dodawanie</option>
            <option value="odejmowanie">Odejmowanie</option>
            <option value="mnozenie">Mnożenie</option>
            <option value="dzielenie">Dzielenie</option>
        </select>
        <input type="number" name="b"><br>
        <input type="submit" name="calculate" value="Oblicz">
    </form>
<!--    <p>Wynik: --><?php //echo $result; ?><!--</p>-->

    <hr>
    <form method="POST" action="">
        <h3>Zaawansowany</h3>
        <input type="number" name="c">
        <select name="metoda" id="metody">
            <option value="cosinus">Cos</option>
            <option value="sinus">Sin</option>
            <option value="tangens">Tg</option>
            <option value="binarne_dziesietne">Binarne na dziesiętne</option>
            <option value="dziesietne_binarne">Dziesiętne na binarne</option>
            <option value="dziesietne_szesnastkowe">Dziesiętne na szesnastkowe</option>
            <option value="szesnastkowe_dziesietne">Szesnastkowe na dziesiętne</option>
        </select><br>
        <input type="submit" name="calculate_advanced" value="Oblicz">
    </form>
<!--    <p>Wynik: --><?php //echo $result_advanced; ?><!--</p>-->

    <?php
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];
        $method = $_POST['funkcje'];
        $result = 0;
        function add($a, $b){
            return $result = $a + $b;
        }


    ?>
</body>
</html>

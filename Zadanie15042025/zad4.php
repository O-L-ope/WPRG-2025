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
    table{
        border: black 1px solid;
    }
    tr{
        border: black 1px solid;
    }
    td{
        border: black 1px solid;
    }
</style>

<body>
<form method="POST" action="">
    <p>Imię: <input type="text" name="imie"></p>
    <p>Nazwisko: <input type="text" name="nazwisko"></p>
    <p>Adres e-mail: <input type="email" name="emailaddress"></p>
    <p>Haslo: <input type="password" name="haslo"></p>
    <p>Wiek: <input type="number" name="wiek"></p>
    <input type="submit" name="register_button" value="Zarejestruj sie">
</form>
<?php
function data_to_table($imie, $nazwisko, $emailaddress, $haslo, $wiek) {
    echo '<table>';
    echo "<tr><td>Imie: $imie</td></tr>";
    echo "<tr><td>Nazwisko: $nazwisko</td></tr>";
    echo "<tr><td>Email: $emailaddress</td></tr>";
    echo "<tr><td>Haslo: $haslo</td></tr>";
    echo "<tr><td>Wiek: $wiek</td></tr>";
    echo '</table>';
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $emailaddress = $_POST["emailaddress"];
    $haslo = $_POST["haslo"];
    $wiek = $_POST["wiek"];

    if (!is_numeric($wiek) || is_numeric($imie) || is_numeric($nazwisko)) {
        echo "Blad";
    } else{
        data_to_table($imie, $nazwisko, $emailaddress, $haslo, $wiek);
    }

}



?>
</body>
</html>

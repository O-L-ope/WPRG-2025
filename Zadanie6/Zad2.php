<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
    <div>
        <input type="number" step="any" name="a">
    </div>
    <div>
        <input type="submit" name="confirm" value="check">
    </div>
</form>
<?php
function numbers($number){
    $number = str_replace('.','',(string) $number);
    $number = array_sum(str_split($number));
    return $number;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST["a"];
    $result = numbers($number);
    echo "<p>$number: $result</p>";
}
?>
</body>
</html>

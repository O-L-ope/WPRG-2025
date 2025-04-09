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
            <input type="submit" name="confirm" value="check">
        </div>
<!--        <div>-->
<!--            <input type="button" value="Reload page" onclick="reloadPage()">-->
<!--        </div>-->
    </form>
    <?php
    function print_primes($a, $b) {
        echo "<p>Liczby pierwsze miedzy $a i $b:</p><p>";
        for ($num = $a; $num <= $b; $num++) {
            if (is_prime($num)) {
                echo $num." ";
            }
        }
        echo "</p>";
    }
    function is_prime($num) {
        if ($num <= 1) {
            return false;
        }
        for ($i = 2; $i <= sqrt($num); $i++) {
            if ($num % $i == 0) {
                return false;
            }
        }
        return true;
    }
    if(isset($_POST["confirm"])){
        if($_POST["a"] < 0 || $_POST["b"] < 0){
            echo "Wartosci a i b nie moga byc ujemne";
        }
        else if(is_numeric($_POST["a"]) && is_numeric($_POST["b"])){
            if($_POST["a"] > $_POST["b"]){
                print_primes(ceil($_POST["b"]), floor($_POST["a"]));
            }
            print_primes(ceil($_POST["a"]), floor($_POST["b"]));
        }
    }
    ?>
</body>
</html>



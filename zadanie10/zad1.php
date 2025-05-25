<?php
    if (isset($_GET['reset'])) {
        setcookie("visit_count", "", time() - 3600);
        header("Location: zad1.php");
        exit();
    }
    $visit_count = isset($_COOKIE['visit_count']) ? intval($_COOKIE['visit_count']) : 0;
    $visit_count++;
    setcookie("visit_count", $visit_count, time() + (86400));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo "<p>Odwiedzono: ".$visit_count."</p>";
        if ($visit_count >= 10){
            echo "<p>Przekroczono limit</p>";
        }
    ?>
    <form method="GET" action="zad1.php">
        <button type="submit" name="reset">Reset</button>
    </form>

</body>
</html>
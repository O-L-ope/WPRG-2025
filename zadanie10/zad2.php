<?php
    if (isset($_COOKIE['locked'])) {
    echo "<h1>Oddano już głos. Odczekaj minutę i odśwież stronę</h1>";
    // echo "<form method='POST' action='zad2.php'><button type='submit' name='reset'>Reset</button></form>";
    // if (isset($_GET['reset'])) {
    //     setcookie("locked", "", time() - 3600);
    //     header("Location: zad1.php");
    //     exit();
    // }
    exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <label for="glosy">Oddaj głos</label><br>
        <select name="glosy" id="glosy">
            <option value="marek">Marek</option>
            <option value="radek">Radek</option>
            <option value="darek">Darek</option>
        </select><br>
        <input type="submit" value="Zagłosuj">
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['glosy'])){
        $user_vote = $_POST['glosy'];
        $upperc_user_vote = ucfirst($user_vote);
        // echo $user_vote;

        setcookie('locked', "1", time() + 60, "/");
        echo "<h1>Oddano głos na: ".$upperc_user_vote."</h1>";
        exit;
    }
    
    ?>
</body>
</html>
<?php
session_start();
$account_login = "test_user";
$account_psw = "123";

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: zad3.php");
    exit;
}

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    echo "<p>Zalogowano jako: {$_SESSION['login']}</p>";
    // echo "<form method='GET'><button type='submit' name='logout' id='logout'>Wyloguj</button></form>";
    echo '<a href="?logout=1">Wyloguj</a>';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['login'];
    $password = $_POST['password'];
    if ($username === $account_login && $password === $account_psw) {
        $_SESSION['logged_in'] = true;
        $_SESSION['login'] = $username;
        echo "<p>Zalogowano pomyślnie ".$username."</p>";
        // echo "<form method='GET'><button type='submit' name='logout' id='logout'>Wyloguj</button></form>";
        echo '<a href="?logout=1">Wyloguj</a>';
        exit;
    } else { //przerobić na elseif i ok (albo ||)
        // if ($username != $account_login){
        //     echo "Zły login";
        // }
        // if ($password != $account_psw){
        //     echo "Złe hasło";
        // }
        echo "<p>Try again</p>";
    }
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
        <label>Login</label><br>
        <input type="text" name="login"><br>
        <label>Password</label><br>
        <input type="password" name="password"><br><br>
        <input type="submit" value="Log in">
    </form>

    <?php
    
    
    ?>
</body>
</html>
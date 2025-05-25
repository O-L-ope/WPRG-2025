<?php
    session_start();

    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("Location: zad4.php");
        exit;
    }
    $user_data = "user_data.txt";

    function check_password($password) {
    return strlen($password) >= 6 && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[^a-zA-Z0-9]/', $password); 
    //^^^elseif(strlen($password) < 6){$alert_message="Hasło musi być dłuższe, niż 6 znaków;}
    //^^^elseif(!(preg_matchh('#[0-9]#', $password))){$alert_message="Hasło musi mieć jedną cyfrę")} itd.
    }

    $alert_message = '';
    if (isset($_POST['register'])) {
        $name = trim($_POST['name'] ?? '');
        $surname = trim($_POST['surname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (!$name || !$surname || !$email || !$password) {
            $alert_message = "Wypełnij pola";
            } elseif (!check_password($password)) {
                $alert_message = " Hasło powinno składać się z co najmniej 6 znaków, zawierać co najmniej 1 wielką literę, cyfrę oraz znak specjalny.";
            } else {
                $exists = false;
                if (file_exists($user_data)) {
                    $lines = file($user_data, FILE_IGNORE_NEW_LINES); //bez ignore nie działa (wczytuje nową linijkę jako " " ?)
                    foreach ($lines as $line) {
                        list($data_name,$data_surname,$data_email,$data_password) = explode(',', $line);
                        if ($data_email === $email) {
                            $exists = true;
                            break;
                        }
                    }
                }
                if ($exists) {
                    $alert_message = "Ten email został już użyty";
                } else {
                    $new_line = "$name,$surname,$email,$password\n";
                    file_put_contents($user_data, $new_line, FILE_APPEND);
                    $alert_message = "Zarejestrowano";
                    // echo "Zarejestrowano";
                }
            }
    }
    $alert_log_message = '';
    if (isset($_POST['login'])) {
        $email = trim($_POST['login_email'] ?? '');
        $password = trim($_POST['login_password'] ?? '');

        if (file_exists($user_data)) {
            $lines = file($user_data, FILE_IGNORE_NEW_LINES); //bez ignore nie działa (wczytuje nową linijkę jako " " ?)
            foreach ($lines as $line) {
                list($data_name,$data_surname,$data_email,$data_password) = explode(',', $line);
                if ($email === $data_email && $password === $data_password) {
                    $_SESSION['user'] = "$data_name $data_surname";
                    header("Location: zad4.php");
                    exit;
                }
            }
            $alert_log_message = "Popraw dane";
        } else {
            $alert_log_message = "Nie ma takiego użytkownika";
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
    <?php
        if(isset($_SESSION['user'])){
            echo "
            <h1>Zalogowany jako: ".$_SESSION['user']."</h1><br>
            <a href='?logout=1'>Wyloguj</a>";
        } else{
            echo "
                <h1>Zarejestruj się</h1>
                <form method='POST'>
                <label>Name</label><br>
                <input type='text' name='name'><br>
                <label>Surname</label><br>
                <input type='text' name='surname'><br>
                <label>Email</label><br>
                <input type='email' name='email'><br>
                <label>Password</label><br>
                <input type='password' name='password'><br><br>
                <input type='submit' name='register' value='Zarejestruj'>
                </form>
    
                <h1>Zaloguj się</h1>
                <form method='POST'>
                    <label>Email</label><br>
                    <input type='email' name='login_email'><br>
                    <label>Password</label><br>
                    <input type='password' name='login_password'><br><br>
                    <input type='submit' name='login' value='Zaloguj'>
                </form>";
            if (!empty($alert_message)) {
                echo "<p>".$alert_message."</p>";
            }
            if (!empty($alert_log_message)) {
                echo "<p>".$alert_log_message."</p>";
            }

        }
    
    
    ?>
    <!-- <h1>Zarejestruj się</h1>
    <form method="POST">
        <label>Name</label><br>
        <input type="text" name="name"><br>
        <label>Surname</label><br>
        <input type="text" name="surname"><br>
        <label>Email</label><br>
        <input type="email" name="email"><br>
        <label>Password</label><br>
        <input type="password" name="password"><br><br>
        <input type="submit" name="register" value="Zarejestruj">
    </form>
    
    <h1>Zaloguj się</h1>
    <form method="POST">
        <label>Email</label><br>
        <input type="email" name="login_email"><br>
        <label>Password</label><br>
        <input type="password" name="login_password"><br><br>
        <input type="submit" name="login" value="Zaloguj">
    </form> -->
</body>
</html>
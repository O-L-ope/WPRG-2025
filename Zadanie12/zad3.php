<?php
    $conn = mysqli_connect("localhost", "root", "", "zadania12");

    $q1 = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS user_data (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(120) NOT NULL,
        lastname VARCHAR(120) NOT NULL,
        age INT NOT NULL,
        email VARCHAR(255) NOT NULL,
        password_hashed VARCHAR(255) NOT NULL
    );");
    
    function check_password($password) {
    return strlen($password) >= 6 && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password) && preg_match('/[^a-zA-Z0-9]/', $password); 
    //^^^elseif(strlen($password) < 6){$info_message="Hasło musi być dłuższe, niż 6 znaków;}
    //^^^elseif(!(preg_matchh('#[0-9]#', $password))){$info_message="Hasło musi mieć jedną cyfrę")} itd.
    }
    $complete_message = '';
    $info_message = '';

    if (isset($_POST['register'])) {
        $name = trim($_POST['name'] ?? '');
        $surname = trim($_POST['surname'] ?? '');
        $age = intval($_POST['wiek'] ?? 0);
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        // $password_hashed = password_hash($password, PASSWORD_ARGON2I);

        // $q2 = mysqli_prepare($conn, "INSERT INTO user_data VALUES (NULL, ?, ?, ?, ?");
        // $q2->bind_param('ssss', $name, $surname, $email, $password_hashed);
        if (!$name || !$surname || !$email || !$password || $age <= 0) {
            $info_message = "Uzupełnij pola";
        } elseif (!check_password($password)) {
            $info_message = "Hasło musi być dłuższe, niż 6 znaków i posiadać jedną cyfrę oraz znak specjalny";
        } else {
            $password_hashed = password_hash($password, PASSWORD_ARGON2I);
            $q2 = mysqli_prepare($conn, "INSERT INTO user_data (firstname, lastname, age, email, password_hashed) VALUES (?, ?, ?, ?, ?)");
            if ($q2) {
                // mysqli_stmt_bind_param($q2, "ssiss", $name, $surname, $age, $email, $password_hashed);
                $q2->bind_param('ssiss', $name, $surname, $age, $email, $password_hashed);
                if (mysqli_stmt_execute($q2)) {
                    $complete_message = "Zarejestrowano i dodano do bazy";
                } else {
                    $info_message = "Wystąpił błąd podczas rejestracji: ".mysqli_error($conn);
                }
            } else {
                $info_message = "Błąd przygotowania zapytania.";
            }
        }
    }

    $user_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM user_data"))[0];

    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles_3.css">
</head>
<body>
    <div id="main_box">
        <div id="main_title">
            <h1 id="register_title"><a href="zad3.php">Zarejestruj się</a></h1>
        </div>
        <div id="register_box">
            <form method='POST'>
                <label>Name</label><br>
                <input type='text' name='name' id="text_box"><br>
                <label>Surname</label><br>
                <input type='text' name='surname' id="text_box"><br>
                <label>Age</label><br>
                <input type='number' name='wiek' id="text_box"><br>
                <label>Email</label><br>
                <input type='email' name='email' id="text_box"><br>
                <label>Password</label><br>
                <input type='password' name='password' id="text_box"><br><br>
                <input type='submit' name='register' value='Zarejestruj' id="button_register">
            </form>
            <?php if ($info_message): ?>
                <p id="info"><?= $info_message ?></p>
            <?php elseif ($complete_message): ?>
                <p id="complete"><?= $complete_message ?></p>
            <?php endif; ?>
        </div>
        <div id="user_count_box">
            <?php
                echo "Zarejestrowani użytkownicy: ".$user_count;
            ?>
        </div>
    </div>
    
    
    
    
    
</body>
</html>
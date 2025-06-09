<?php
    session_start();
    // $conn = mysqli_connect("localhost", "root", "", "zadania12");
    $conn = new mysqli("localhost", "root", "", "zadania12");

    if($conn->connect_error){
        echo "Katastrofa".$conn->connect_error;
    }
    
    $kwarenda1 = "CREATE TABLE IF NOT EXISTS student ( 
    studentID INT PRIMARY KEY AUTO_INCREMENT, 
    firstname VARCHAR(255) NOT NULL, 
    secondname VARCHAR(255) NOT NULL, 
    salary INT NOT NULL, 
    dateOfBirth DATE NOT NULL );";
    
    $message = '';
    // if($conn->query($kwarenda1) === TRUE){
    //     echo "Kwarenda utworzenia tabeli działa";
    // } else {
    //     echo "Fatalnie".$conn->connect_error;
    // }
    if(isset($_SESSION['table_deleted']) === FALSE){
        mysqli_query($conn, $kwarenda1);
        $message = "Utworzono tabelę";
        // echo $message."<br>";
        // if($conn->query($kwarenda1) === TRUE){
        //     echo "Kwarenda utworzenia tabeli działa";
        // } else {
        //     echo "Fatalnie".$conn->connect_error;
        // }
    }
    // echo $message;
    $kwarenda_delete = "DROP TABLE IF EXISTS student;";

    if(isset($_POST['table_remover'])){
        if($conn->query($kwarenda_delete) === TRUE){
            $_SESSION['table_deleted'] = true;
            $message = "Usunięto tabelę";
            // echo $message."<br>";
        } else {
            echo "Failed".$conn->error;
        }
    }
    echo $message;
    // if(session_destroy()){
    //     header("Location: ".$_SERVER['PHP_SELF']);
    // }
    session_destroy();

    // if(isset($_SESSION['table_deleted']) && $_SESSION['table_deleted'] === TRUE){
    //     // mysqli_query($conn, $kwarenda1);
    //     unset($_SESSION['table_deleted']);
    // }
    
    // $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($kwarenda1):?>
        <h1>Manage MySQL Table</h1>
        <form method="POST">
            <button name="table_remover" id="table_remover">Usuń tabelę</button>
        </form>
    <?php endif; ?>
</body>
</html>


<?php
$conn->close();
?>
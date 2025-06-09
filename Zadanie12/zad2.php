<?php
    // try {
        $connect = new PDO("mysql:host=localhost;dbname=zadania12", "root", "");
    
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $query_create_table = "
        //     CREATE TABLE IF NOT EXISTS Person (
        //     person_id INT AUTO_INCREMENT PRIMARY KEY,
        //     person_firstname VARCHAR(255) NOT NULL,
        //     person_secondname VARCHAR(255) NOT NULL
        // );

        //     CREATE TABLE IF NOT EXISTS Cars (
        //     cars_id INT AUTO_INCREMENT PRIMARY KEY,
        //     cars_model VARCHAR(255) NOT NULL,
        //     cars_price FLOAT NOT NULL,
        //     cars_day_of_buy DATETIME NOT NULL
        // );

        //     ALTER TABLE Cars ADD IF NOT EXISTS person_id INT NOT NULL DEFAULT 0;

        //     ALTER TABLE Cars ADD CONSTRAINT fk_person_id FOREIGN KEY (person_id) REFERENCES Person(person_id);
        // ";

        $query_create_table = "
            CREATE TABLE IF NOT EXISTS Person (
                person_id INT AUTO_INCREMENT PRIMARY KEY,
                person_firstname VARCHAR(255) NOT NULL,
                person_secondname VARCHAR(255) NOT NULL
            );

            CREATE TABLE IF NOT EXISTS Cars (
                cars_id INT AUTO_INCREMENT PRIMARY KEY,
                cars_model VARCHAR(255) NOT NULL,
                cars_price FLOAT NOT NULL,
                cars_day_of_buy DATETIME NOT NULL,
                person_id INT,
                CONSTRAINT fk_person_id FOREIGN KEY (person_id) REFERENCES Person(person_id)
            );";


    // } catch (PDOException $e) {
    //     echo "Coś".$e->getMessage();
    // }

    $result = $connect->query($query_create_table);
    if (!$result){
        echo "Nie powiodło się<br>";
    } else {
        echo "Udało się<br>";
    }
    $result->closeCursor();


    // $query_insert_person = $connect->prepare("INSERT INTO Person VALUES (:person_firstname, :person_secondname)");
    if (isset($_GET['send_to_db'])) {
            $firstname = trim($_GET['firstname']);
            $surname = trim($_GET['lastname']);

            $query_insert_person = $connect->prepare("INSERT INTO Person (person_firstname, person_secondname) VALUES (:person_firstname, :person_secondname)");
            $query_insert_person->bindParam(':person_firstname', $firstname);
            $query_insert_person->bindParam(':person_secondname', $surname);
            if ($query_insert_person->execute()) {
                echo "Wprowadzono osobę do bazy";
            } else {
                echo "Nie udało się wprowadzić osoby do bazy";
            }
            $query_insert_person->closeCursor();
        }


    if (isset($_GET['DELETE_VALUES'])) {
            $person_id_to_delete = $_GET['person_id']; // Pobieramy ID osoby do usunięcia
            $delete_query = "DELETE FROM Person WHERE person_id = :person_id";
            $query_delete_person = $connect->prepare($delete_query);
            $query_delete_person->bindParam(':person_id', $person_id_to_delete);
            if ($query_delete_person->execute()) {
                echo "Osoba została usunięta<br>";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Nie udało się usunąć osoby<br>";
            }
        }
    
    if (isset($_GET['add_car'])){
        $carmodel = $_GET['carmodel'];
        $carprice = $_GET['carsprice'];
        $dayofbuy = $_GET['dayofbuy'];
        $person_car = $_GET['person_selector'];

        $query_check_person = $connect->prepare("SELECT person_id FROM Person WHERE person_id = :person_id");
        $query_check_person->bindParam(':person_id', $person_car);
        $query_check_person->execute();

        if($query_check_person->rowCount() > 0){
            $query_add_car = "INSERT INTO Cars (cars_model, cars_price, cars_day_of_buy, person_id) VALUES (:cars_model, :cars_price, :cars_day_of_buy, :person_id)";
        $prepare_add_car = $connect->prepare($query_add_car);
        $prepare_add_car->bindParam(':cars_model', $carmodel);
        $prepare_add_car->bindParam(':cars_price', $carprice);
        $prepare_add_car->bindParam(':cars_day_of_buy', $dayofbuy);
        $prepare_add_car->bindParam(':person_id', $person_car);
        if ($prepare_add_car->execute()){
            echo "Dodano auto";
        } else {
            echo "Dodanie się nie udało";
        }
        $prepare_add_car->closeCursor();
        }
        
        // $query_add_car = "INSERT INTO Cars (cars_model, cars_price, cars_day_of_buy, person_id) VALUES (:cars_model, :cars_price, :cars_day_of_buy, :person_id)";
        // $prepare_add_car = $connect->prepare($query_add_car);
        // $prepare_add_car->bindParam(':cars_model', $carmodel);
        // $prepare_add_car->bindParam(':cars_price', $carprice);
        // $prepare_add_car->bindParam(':cars_day_of_buy', $dayofbuy);
        // $prepare_add_car->bindParam(':person_id', $person_car);
        // if ($prepare_add_car->execute()){
        //     echo "Dodano auto";
        // } else {
        //     echo "Dodanie się nie udało";
        // }
        // $prepare_add_car->closeCursor();
    }




    // $connect = null;
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($result): ?>
        <h1>Manage MySQL Database</h1>
        <h3>Add Person</h3>
        <form method="GET">
            <input type="text" name="firstname" id="firstname" placeholder="First Name"><br><br>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name"><br><br>
            
            <input type="submit" name="send_to_db" id="send_to_db" value="Add Person"><br><br>
        </form>
        <h3>Add Car</h3>
        <form method="GET">
            <input type="text" name="carmodel" id="carmodel" placeholder="Car Model"><br><br>
            <input type="number" step="any" name="carsprice" id="carsprice" placeholder="Car's price"><br><br>
            <label for="dayofbuy">Data zakupu</label><br>
            <input type="date" name="dayofbuy" id="dayofbuy"><br><br>
            <select name="person_selector">
            <?php
                $query_select_persons = $connect->query("SELECT person_firstname, person_secondname FROM Person");

                // while($rows = $query_select_persons->fetch()){
                //     $person_selector = $rows['person_firstname'];
                //     echo "<option value='$person_selector'>$person_selector</option>";
                // }
                while($rows = $query_select_persons->fetch(PDO::FETCH_ASSOC)){
                    echo "<option value='".$rows['id']."'>".$rows['person_firstname']." ".$rows['person_secondname']."</option>";
                }

                // <select name="person_option" required>
                //     <option></option>
                // </select>
            ?>
            </select>
            <input type="submit" name="add_car" value="Dodaj car">
        </form>

        <style>
            table, tr, th, td{
                border: black 1px solid;
                border-collapse: collapse;
            }
        </style>

        
        <h1>Persons</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Action</th>
            </tr>    
        
        <?php
            $query_person_display = $connect->query("SELECT * FROM Person");
            while($rows = $query_person_display->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . htmlspecialchars($rows['person_id']) . "</td>";
                echo "<td>" . htmlspecialchars($rows['person_firstname']) . "</td>";
                echo "<td>" . htmlspecialchars($rows['person_secondname']) . "</td>";
                echo "<td><form method='get'><input type='hidden' name='person_id' value='".$rows['person_id']."'><button type='submit' name='edit_values'>Edit</button><button type='submit' name='DELETE_VALUES'>DELETE</button></form>";
                echo "</tr>";
            }
        ?>
        </table>

        <h1>Cars</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Car model</th>
                <th>Price</th>
                <th>Day of purchase</th>
                <th>Person ID</th>
                <th>Action</th>
            </tr>    
        
        <?php
            $query_car_display = $connect->query("SELECT * FROM Cars");
            while($rows = $query_car_display->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>" . htmlspecialchars($rows['cars_id']) . "</td>";
                echo "<td>" . htmlspecialchars($rows['cars_model']) . "</td>";
                echo "<td>" . htmlspecialchars($rows['cars_price']) . "</td>";
                echo "<td>" . htmlspecialchars($rows['cars_day_of_buy']) . "</td>";
                echo "<td>" . htmlspecialchars($rows['person_id']) . "</td>";
                echo "<td><form method='get'><button name='edit_values'>Edit</button><button name='DELETE_VALUES'>DELETE</button></form>";
                echo "</tr>";
            }
        ?>
        </table>
    <?php endif; ?>
</body>
</html>




<?php
    $connect=null;
?>
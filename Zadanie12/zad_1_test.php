<?php
session_start();
// Połączenie z bazą danych
$conn = new mysqli("localhost", "root", "", "zadania12");

// Sprawdzanie połączenia
if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}

// Kwerenda do tworzenia tabeli
$kwerenda_create = "CREATE TABLE IF NOT EXISTS student_test (
    studentID INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    secondname VARCHAR(255) NOT NULL,
    salary INT NOT NULL,
    dateOfBirth DATE NOT NULL
);";

// Kwerenda do usuwania tabeli
$kwerenda_delete = "DROP TABLE IF EXISTS student_test;";

// Obsługa formularza do usuwania tabeli
if (isset($_POST['table_remover'])) {
    // Usuwanie tabeli
    if ($conn->query($kwerenda_delete) === TRUE) {
        $_SESSION['table_deleted'] = true; // Zapisujemy stan sesji, że tabela została usunięta
        // Przekierowanie na tę samą stronę, aby odświeżyć ją i ponownie utworzyć tabelę
    } else {
        echo "Błąd podczas usuwania tabeli: " . $conn->error;
    }
}

// Sprawdzamy, czy tabela została usunięta i jeżeli tak, tworzymy ją ponownie
if (isset($_SESSION['table_deleted']) && $_SESSION['table_deleted'] === true) {
    // Tworzymy tabelę na nowo
    if ($conn->query($kwerenda_create) === TRUE) {
        echo "Tabela została ponownie utworzona.";
    } else {
        echo "Błąd przy tworzeniu tabeli: " . $conn->error;
    }

    // Usuwamy flagę z sesji, aby przy kolejnych odświeżeniach tabela już nie była tworzona ponownie
    unset($_SESSION['table_deleted']);
} else {
    // Tworzymy tabelę, jeśli jej jeszcze nie ma
    if ($conn->query($kwerenda_create) === TRUE) {
        echo "Tabela została utworzona lub już istnieje.";
    } else {
        echo "Błąd przy tworzeniu tabeli: " . $conn->error;
    }
}

// Zamykanie połączenia
// $conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage MySQL Table</title>
</head>
<body>
    <h1>Zarządzanie tabelą w MySQL</h1>

    <!-- Formularz z przyciskiem do usunięcia tabeli -->
    <form method="POST">
        <button type="submit" name="table_remover" id="table_remover">Usuń tabelę</button>
    </form>
</body>
</html>

<?php
// Zamykamy połączenie po zakończeniu operacji
$conn->close();
?>

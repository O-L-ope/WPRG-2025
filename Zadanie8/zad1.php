<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" id="tekst" name="tekst"><br>
        <input type="submit" value="send">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $changed_text = $_POST['tekst'];
            echo "Wielkie litery: " . strtoupper($changed_text). "<br>";
            echo "Małe litery: " . strtolower($changed_text) . "<br>";
            echo "Pierwsza litera wielka: " . ucfirst(strtolower($changed_text)) . "<br>";
            echo "Pierwsze litery słów wielkie: " . ucwords(strtolower($changed_text)) . "<br>";
        }
    ?>
</body>
</html>
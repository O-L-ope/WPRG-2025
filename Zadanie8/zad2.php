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
            $fixed_text = str_replace(['\\', '/', ':', '*', '?', '"', '<', '>', '|', '+', '-', '.'], ' ', $changed_text); //$ddsad[] i replace($ddsad, " ", $changed_text) (do testu)
            echo "Poprawiony tekst: " . $fixed_text."<br>";
        }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" id="tekst" name="tekst">
        <input type="submit" value="Wyślij">
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $tekst = $_POST['tekst'];
            $samogloski = 0;
            $lower_case_tekst = strtolower($tekst);
            foreach (str_split($lower_case_tekst) as $char) {
                if (in_array($char, ['a', 'e', 'i', 'o', 'u'])){
                    $samogloski++;
                }
            }
            echo "Liczba samogłosek: ".$samogloski;
        }
    ?>
</body>
</html>
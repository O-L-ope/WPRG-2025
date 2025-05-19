<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if ($fd = file_exists('adresy.txt')) {
        $lines = file('adresy.txt');
        echo "<ul>";
        foreach ($lines as $line) {
            list($url, $description) = explode(";", $line);
            echo "<li><a href=$url target=_blank>$url</a> $description</li>";
        }
    echo "</ul>";
    }
?>

</body>
</html>
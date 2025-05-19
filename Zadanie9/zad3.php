<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //!!!! Też działa
        // $fp = 'licznik_v2.txt';
        // if (file_exists($fp)) {
        //     $count = file_get_contents($fp);
        // }
        // $count++;
        // file_put_contents($fp, $count); 
        // echo "View count: $count";

        //!!!! Też działa
        if (!$fd = fopen('licznik_v1.txt', 'r+')){
            echo 'Nie ma pliku';
        } else {
            // echo readfile('licznik.txt');
            $counter = (int)fgets($fd);
            $counter++;
            fseek($fd, 0);
            fwrite($fd, $counter);
            fclose($fd);
            echo "View count: ".$counter;
        }
?>
</body>
</html>
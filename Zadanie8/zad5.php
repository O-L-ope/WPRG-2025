<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <!-- <input type="number" step="any" name="znaki"> -->
        <input type="text" id="znaki" name="znaki">
        <input type="submit" value="Wyślij">
    </form>

    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $znaki = $_POST['znaki'];
            $result = 0;
            $int = '';
            $dec = '';
            
            if (empty($znaki)){
                echo "Podaj liczbę";
            } else {
                if(strpos($znaki, ',') == false){
                echo "Brak liczby zmiennoprzecinkowej";
            } else {
                list($int, $dec) = explode(',', $znaki);
                
                foreach (str_split($dec) as $char) {
                    $result++;
                }
                echo $result;
            }
            }
            }
            
            
            

            // echo $int."<br>";
            // echo $dec;

            
            
    ?>
</body>
</html>
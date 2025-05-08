<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_do_3.css" type="text/css">
</head>
<body>
    <form method="POST">
        <input type="text" id="tekst" name="tekst">
        <select id="operation" name="operation">
            <option value="odwrocenie">Odwróć</option>
            <option value="to_upper">Wielkie litery</option>
            <option value="to_lower">Małe litery</option>
            <option value="countsymbols">Liczenie znaków</option>
            <option value="trimy">Usuń białe znaki</option>

        </select>
        <!-- <input type="submit" value="Wykonaj" id="submit_button"> -->
        <button type="submit" id="submit_button">Wykonaj</button>
    </form>


    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $tekst = $_POST['tekst'];
            $operation = $_POST['operation'];
            $result = '';

            // if (isset($_POST['submit_button'])){
            //     if(empty($_POST['tekst'])){
            //         echo "Wypełnij pole formularza";
            //     }else
            //     switch ($operation){
            //     case 'odwrocenie':
            //         $result = strrev($tekst);
            //         break;
            //     case 'to_upper':
            //         $result = strtoupper($tekst);
            //         break;
            //     case 'to_lower':
            //         $result = strtolower($tekst);
            //         break;
            //     case 'countsymbols':
            //         $result = count_chars($tekst);
            //         // $result = strlen($tekst);
            //         break;
            //     case 'trimy':
            //         $result = trim($tekst);
            //         break;
            //     default:
            //         echo "Niepoprawne dane";
            //         break;
            // }

                switch ($operation){
                case 'odwrocenie':
                    $result = strrev($tekst);
                    break;
                case 'to_upper':
                    $result = strtoupper($tekst);
                    break;
                case 'to_lower':
                    $result = strtolower($tekst);
                    break;
                case 'countsymbols':
                    $result = count_chars($tekst);
                    // $result = strlen($tekst);
                    break;
                case 'trimy':
                    $result = trim($tekst);
                    break;
                default:
                    echo "Niepoprawne dane";
                    break;
            }
            
            echo "Wynik: ".$result;
            }

    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET">
        <input type="date" name="kalendarz" id="kalendarz">
        <input type="submit" value="Wyślij">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['kalendarz'])){
            $kalendarz = $_GET['kalendarz'];
        }
        // $kalendarz = $_GET['kalendarz'];
        if (empty($kalendarz)){
            echo "Podaj datę";
        } else{
        echo "Wybrana data: ".$kalendarz."<br>";
        function week_day($kalendarz) {
            $date = new DateTime($kalendarz);
            $dni_tygodnia = $date->format('l'); //strftime?
            $translated_dni_tygodnia = [
                'Monday' => 'Poniedziałek',
                'Tuesday' => 'Wtorek',
                'Wednesday' => 'Środa',
                'Thursday' => 'Czwartek',
                'Friday' => 'Piątek',
                'Saturday' => 'Sobota',
                'Sunday' => 'Niedziela',
            ];
            return $translated_dni_tygodnia[$dni_tygodnia];
        }
        function wiek($kalendarz) {
            $kalendarz = new DateTime($kalendarz);
            $today = new DateTime();
            // $today = date("Y");
            $age = $today->diff($kalendarz);
            return $age->y;
        }
        function birthday($kalendarz) {
            $data_urodzenia = new DateTime($kalendarz);
            $today = new DateTime();
            $nextBirthday = new DateTime($today->format('Y') . '-' . $data_urodzenia->format('m-d'));
            if ($nextBirthday < $today) {
                $nextBirthday->modify('+1 year');
            }
            $interval = $today->diff($nextBirthday);
            return $interval->days;
            }
            echo "Dzień tygodnia: ".week_day($kalendarz)."<br>";
            echo "Wiek: ".wiek($kalendarz)." lat/lata<br>";
            echo "Dni do kolejnych urodzin: ".birthday($kalendarz);
        }        
    }
    
    ?>
</body>
</html>
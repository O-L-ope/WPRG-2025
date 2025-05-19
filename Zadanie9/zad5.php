<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $f_banned_ips = 'banned_ips.txt';
        $user_ip = $_SERVER['REMOTE_ADDR'];
        // echo $user_ip; //do sprawdzenia IP, bo local nie działa
        if (file_exists($f_banned_ips)) {
            $banned_ips = file($f_banned_ips);
            if (in_array($user_ip, $banned_ips)) {
                include('podstrony_zad5/banned_page.php');
            } else {
                include('podstrony_zad5/standard_page.php');
            }
        }
?>
</body>
</html>
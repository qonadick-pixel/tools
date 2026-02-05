<?php
    require 'config.php';

    function getIp() {
        $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
        ];
        foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(end(explode(',', $_SERVER[$key])));
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip;
            }
        }
        }
    }
    
    if ($_GET['hash']) {
        $hash = $_GET['hash'];
        // Получаем id и подтверждено ли Email
        if ($result = mysqli_query($con, "SELECT `id`, `podozritelni_vxod` FROM `qwe_users` WHERE `hashtwo`='" . $hash . "'")) {
            while( $row = mysqli_fetch_assoc($result) ) { 
                if ($row['podozritelni_vxod'] == 1) {
                    mysqli_query($con, "UPDATE `qwe_users` SET `podozritelni_vxod`=0, `last_ip`=".getIp()." WHERE `id`=". $row['id'] );
                    echo "<center>Вход подтверждён</center>";
                } else {
                    echo "<center>У вас уже подтвержденный вход!</center>"; 
                }
            } 
        } else {
            echo "<center>Что-то пошло не так, обратитесь к администрации!</center>";
        }
    } else {
        echo "<center>Что-то пошло не так, обратитесь к администрации!</center>";
    }
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
        <meta charset="UTF-8">
        <title>Подтверждение — Grand Tools</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/app.css">
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <meta name="msapplication-TileColor" content="#d40d0d" />
        <meta name="theme-color" content="#ffffff" />

        <link rel="stylesheet" href="/css/font-awesome.min.css">

        <!-- Notifications -->
        <link rel="stylesheet" href="/js/dist/simple-notify.min.css" />
        <script src="/js/dist/simple-notify.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	</head>
</html>
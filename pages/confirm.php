<?php
    require 'config.php';
    
    if ($_GET['hash']) {
        $hash = $_GET['hash'];

        $sql = "SELECT count(*) FROM qwe_users WHERE `hash`='".$hash."'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($res);
        $countuser = $row[0];

        if($countuser != 0) {
            if ($result = mysqli_query($con, "SELECT `id`, `active_acc` FROM `qwe_users` WHERE `hash`='" . $hash . "'")) {
                while( $row = mysqli_fetch_assoc($result) ) { 
                    if ($row['active_acc'] == 0) {
                        mysqli_query($con, "UPDATE `qwe_users` SET `active_acc`=1 WHERE `id`=". $row['id'] );
                        echo "<center style='color: #fff;'><h1>Email подтверждён</h1></center>";
                    } else {
                        echo "<center style='color: #fff;'><h1>Ваша почта уже активирована!</h1></center>"; 
                    }
                } 
            } else {
                echo "<center style='color: #fff;'>Что-то пошло не так, обратитесь к администрации!</center>";
            }
        } else {
            echo "<center style='color: #fff;'>Что-то пошло не так, обратитесь к администрации!</center>";
        }
    } else {
        echo "<center style='color: #fff;'>Что-то пошло не так, обратитесь к администрации!</center>";
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
        <meta charset="UTF-8">
        <title>Подтверждение — Grand Tools</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/login.css">
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script src="https://kit.fontawesome.com/60ffe1824d.js" crossorigin="anonymous"></script>
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <meta name="msapplication-TileColor" content="#d40d0d" />
        <meta name="theme-color" content="#ffffff" />

        <link rel="stylesheet" href="/css/font-awesome.min.css">

        <link href="https://cdn.jsdelivr.net/gh/Alaev-Co/snowflakes/dist/snow.min.css" rel="stylesheet">

        <!-- Notifications -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8"></script>
        <link rel="stylesheet" href="/js/dist/simple-notify.min.css" />
        <script src="/js/dist/simple-notify.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/preload.css">
        <style>
            body {
                background-color: #1D1C24;
            }
        </style>
	</head>
    <script src="/js/preload.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/Alaev-Co/snowflakes/dist/Snow.min.js"></script>
	<script>
		new Snow ({
            snowPlowImage: false,
            showSnowBalls: false,
        });
	</script>
</html>
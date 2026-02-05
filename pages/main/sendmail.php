<?php
    require ("../config.php");
    require ('../engine/smtp_mailer.php');

    $type = $_GET['type'];

	$query = "SELECT * FROM qwe_users WHERE name='".$_SESSION['name']."'";
    $result = mysqli_query($con,$query);
    $user = mysqli_fetch_assoc($result);

    if($type == 'changepass') {
        $codeforchange = rand(000001,999999);
        $mail->isHTML(true);
        $mail->addAddress($user['email']);
        $mail->Subject = 'СМЕНА ПАРОЛЯ Grand Tools';
        $mail->msgHTML("<html><body>
        <p>Ваш логин: ".$user['name']."</p>
        <p>Ваш код для смены пароля: <strong>".$codeforchange."</strong></p>
        </html></body>");
        $mail->send();
        $result = mysqli_query($con,"UPDATE `qwe_users` SET `codeforpass` = $codeforchange WHERE `id` = '".$user['id']."' LIMIT 1");
        die('YES');
    }
?>
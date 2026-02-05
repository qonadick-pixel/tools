<?php
    require ('config.php');
    require ('../engine/smtp_mailer.php');

    $le = $_GET['name'];
    $hash = md5($login . time());

    $query = 'SELECT * FROM qwe_users WHERE email="'.$le.'"';
    $result = mysqli_query($con,$query);
    $user = mysqli_fetch_assoc($result); 

    $sql = "SELECT count(*) FROM qwe_users WHERE email='".$le."'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($res);
    $countuser = $row[0];

    if($countuser != 0)
    {   
        mysqli_query($con, "UPDATE `qwe_users` SET `hash_pass`='$hash' WHERE `id`=". $user['id']);
        mysqli_close($con);
        $mail->isHTML(true);
        $mail->addAddress($le);
        $mail->Subject = 'ВОССТАНОВЛЕНИЕ ПАРОЛЯ В Grand Tools';
        $mail->msgHTML("<html><body>
        <h1>Ваш логин: ".$user['name']."</h1>
        <p>Для того, чтобы сменить пароль, перейдите по <a href='https://grndtools.ru/pages/recoverypass.php?hash=".$hash."'>ссылке</a>.</p>
        </html></body>");
        $mail->send();
        die('YES');
        exit();
    } else {
        die('#Ошибка Аккаунт с такой почтой отсутствует!');
    }

    exit();
?>
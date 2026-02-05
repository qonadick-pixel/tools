<?php
    session_start();
    require ("config.php");
    require ('../engine/smtp_mailer.php');

    $type = $_GET['type'];

	$query = "SELECT * FROM qwe_users WHERE name='".$_SESSION['name']."'";
    $result = mysqli_query($con,$query);
    $user = mysqli_fetch_assoc($result);

    $codeforchange = rand(100000,999999);
    $mail->isHTML(true);

    if($type == 'emailone' || $type == 'emailtwo') {
        if($user['email'] == $_GET['newemail']) {
            die('#Ошибка Данная почта уже зарегистрирована в системе');
        }
    }

    if($type == 'changepass' || $type == 'emailone') $pidoras = time() - $user['cooldown_button'];
    if($type == 'emailtwo') $pidoras = time() - $user['cooldown_button2'];


    if($pidoras > 60) {
        if($type == 'changepass') {
            $mail->addAddress($user['email']);
            $mail->Subject = 'СМЕНА ПАРОЛЯ Grand Tools';
            $mail->msgHTML("<html><body>
            <p>Ваш логин: ".$user['name']."</p>
            <p>Ваш код для смены пароля: <strong>".$codeforchange."</strong></p>
            </html></body>");
            $mail->send();
            $result = mysqli_query($con,"UPDATE `qwe_users` SET `codeforpass` = $codeforchange, `cooldown_button` = '".time()."' WHERE `id` = '".$user['id']."' LIMIT 1");
            die('#mailsent Код для смены пароля отправлен на вашу почту ('.$user['email'].')');
        } else if($type == 'emailone') {
            $mail->addAddress($user['email']);
            $mail->Subject = 'СМЕНА ПОЧТЫ Grand Tools';
            $mail->msgHTML("<html><body>
            <p>Ваш логин: ".$user['name']."</p>
            <p>Ваш код для смены почты: <strong>".$codeforchange."</strong></p>
            </html></body>");
            $mail->send();
            $result = mysqli_query($con,"UPDATE `qwe_users` SET `codemailone` = $codeforchange, `cooldown_button` = '".time()."' WHERE `id` = '".$user['id']."' LIMIT 1");
            die('#oldmailsent Код для смены почты отправлен на вашу старую почту ('.$user['email'].')');
        } else if($type == 'emailtwo') {
            if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $_GET['newemail'])) {
                $mail->addAddress($_GET['newemail']);
                $mail->Subject = 'СМЕНА ПОЧТЫ Grand Tools';
                $mail->msgHTML("<html><body>
                <p>Ваш логин: ".$user['name']."</p>
                <p>Ваш код для смены почты: <strong>".$codeforchange."</strong></p>
                </html></body>");
                $mail->send();
                $result = mysqli_query($con,"UPDATE `qwe_users` SET `codemailtwo` = $codeforchange, `cooldown_button2` = '".time()."' WHERE `id` = '".$user['id']."' LIMIT 1");
                die('#newmailsent Код для смены почты отправлен на вашу новую почту ('.$_GET['newemail'].')');
            } else {
                die('#error Указана неверная почта! Код не отправлен');
            }
        }
    } else {
        $pidoras = 60 - $pidoras;
        die('#error Письмо можно отправлять раз в минуту!<br>Осталось: '.$pidoras.' секунд.');
    }
?>
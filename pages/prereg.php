<?php
    require ('config.php');
    require ('../engine/smtp_mailer.php');

    $ln = $_GET['ln'];
    $le = $_GET['le'];
    $lp = $_GET['lp'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $hash = md5($login . time());

    $query = 'SELECT * FROM qwe_users WHERE email="'.$le.'" OR name="'.$ln.'"';
    $result = mysqli_query($con,$query);
    $user = mysqli_fetch_assoc($result); 

    $sql = 'SELECT count(*) FROM qwe_users WHERE email="'.$le.'" OR UPPER(name)= UPPER("'.$ln.'")';
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($res);
    $countuser = $row[0];
    
    if($countuser == 0)
    {
        if (!preg_match('/[А-Яа-яЁё]/u', $ln)) {
            if (!preg_match("/[^A-Za-z0-9]/", $ln)) {
                if (filter_var($le, FILTER_VALIDATE_EMAIL)) {
                    if(strlen($ln) < 21 && strlen($ln) > 4) {
                        if(preg_match("/[^A-Z]/", $lp)) {
                            if(preg_match("/[0-9]/", $lp)) {
                                if(!preg_match("[\.:,;\?!@#\$%\^&\*_\-\+=]", $lp)) {
                                    $result = mysqli_query($con,"INSERT INTO `qwe_users`(`name`, `pass`, `email`, `ip_address`, `last_ip`, `hash`) VALUES ('$ln', '$lp', '$le', '$ip', '$ip', '$hash')");
                                    mysqli_close($con);
                                    $mail->isHTML(true);
                                    $mail->addAddress($le);
                                    $mail->Subject = 'АВТОРИЗАЦИЯ В ПАНЕЛЬ Grand Tools!';
                                    $mail->msgHTML("<html><body>
                                    <h1>Ваш логин: ".$ln."</h1>
                                    <h1>Ваш пароль: ".$lp."</h1>
                                    <p>Для того, чтобы подтвердить почту, перейдите по <a href='https://grndtools.ru/pages/confirm.php?hash=".$hash."'>ссылке</a>.</p>
                                    </html></body>");
                                    $mail->send();
                                    die('YES');
                                    exit();
                                } else {
                                    die("#Ошибка В вашем пароле отсутвуют спец. символы");
                                }
                            } else {
                                die('#Ошибка В вашем пароле отсутствуют цифры');
                            }
                        } else {
                            die('#Ошибка В вашем пароле отсутвуют заглавные буквы');
                        }
                    } else {
                        die('#Ошибка Длина логина должна быть минимум 5 и не более 20 символов');
                    }
                } else {
                    die('#Ошибка Укажите верную почту');
                }
            } else {
                die('#Ошибка Укажите верный логин'); 
            }
        } else {
            die('#Ошибка Логин не должен иметь русские символы');
        }
    } else if($countuser != 0) {
        die('#Ошибка Аккаунт с данной почтой или логином уже существует!');
    }

    exit();
?>
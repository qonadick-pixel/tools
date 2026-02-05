<?php
    session_start();
    require ('config.php');

    $pass = $_GET['pass'];

    if($_GET['type'] == 'recoverypass') {
        $query = "SELECT * FROM qwe_users WHERE `hash_pass`='".$_SESSION['hash123']."'";
        $result = mysqli_query($con,$query);
        $user = mysqli_fetch_assoc($result);

        if($user['pass'] != $pass) {
            $hashnew = md5($login . time());
            mysqli_query($con, "UPDATE `qwe_users` SET `pass`='$pass' WHERE `hash_pass`='".$_SESSION['hash123']."'");
            mysqli_query($con, "UPDATE `qwe_users` SET `hash_pass`='$hashnew' WHERE `hash_pass`='".$_SESSION['hash123']."'");
            mysqli_close($con);
            die("YES");
        } else {
            die("#Ошибка Ваш новый пароль соответствует текущему! Придумайте другой");
        }
    } else if($_GET['type'] == 'editpass') {
        $codeforedit = $_GET['codepass'];
        $passone = $_GET['passone'];

        $sql = "SELECT count(*) FROM qwe_users WHERE `codeforpass`='".$codeforedit."'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($res);
        $countuser = $row[0];
        if($countuser != 0) {
            if(preg_match("/[^A-Z]/", $pass)) {
                if(preg_match("/[0-9]/", $pass)) {
                    if(!preg_match("[\.:,;\?!@#\$%\^&\*_\-\+=]", $pass)) {
                        $query = "SELECT * FROM qwe_users WHERE `codeforpass`='".$codeforedit."'";
                        $result = mysqli_query($con,$query);
                        $user = mysqli_fetch_assoc($result);
                        if($user['pass'] == $passone) {
                            mysqli_query($con, "UPDATE `qwe_users` SET `pass`='$pass' WHERE `codeforpass`='".$codeforedit."'");
                            mysqli_query($con, "UPDATE `qwe_users` SET `codeforpass`='000000' WHERE `codeforpass`='".$codeforedit."'");
                            die('YES');
                        } else {
                            die('#error Вы ввели неверный старый пароль!');
                        }
                    } else {
                        die("#error В вашем пароле отсутвуют спец. символы");
                    }
                } else {
                    die('#error В вашем пароле отсутствуют цифры');
                }
            } else {
                die('#error В вашем пароле отсутвуют заглавные буквы');
            }
        } else {
            die('#error Вы ввели неверный код для смены пароля!');
        }
    }

    exit();
?>
<?php
    session_start();
    require ('config.php');

    $codeone = $_GET['codeone'];
    $codetwo = $_GET['codetwo'];
    $newemail = $_GET['newemail'];

    $sql = "SELECT count(*) FROM qwe_users WHERE `email`='".$newemail."'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($res);
    $newemailcount = $row[0];

    if($newemailcount == 0) {
        $sql = "SELECT count(*) FROM qwe_users WHERE `codemailone`='".$codeone."'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($res);
        $countmailone = $row[0];
        if($countmailone != 0) {
            $sql = "SELECT count(*) FROM qwe_users WHERE `codemailtwo`='".$codetwo."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($res);
            $countmailtwo = $row[0];
            if($countmailtwo != 0) {
                mysqli_query($con, "UPDATE `qwe_users` SET `email`='$newemail' WHERE `codemailtwo`='".$codetwo."'");
                mysqli_query($con, "UPDATE `qwe_users` SET `codemailtwo`='000000', `codemailone`='000000' WHERE `codemailtwo`='".$codetwo."'");
                die('YES');
            } else {
                die('#error Вы ввели неверный код с новой почты!');
            }
        } else {
            die('#error Вы ввели неверный код со старой почты!');
        }
    } else {
        mysqli_query($con, "UPDATE `qwe_users` SET `codemailtwo`='000000' WHERE `name`='".$_SESSION['name']."'");
        die('#error Аккаунт с такой почтой уже создан на сайте!');
    }

    exit();
?>
<?php
    session_start();
    require ("config.php");

    // 0 - ХВИД РЕКВЕСТ | 1 - ИП РЕКВЕСТ

    $type = $_GET['type'];
    $ip = $_SERVER['REMOTE_ADDR'];

	$query = "SELECT * FROM qwe_users WHERE name='".$_SESSION['name']."'";
    $result = mysqli_query($con,$query);
    $user = mysqli_fetch_assoc($result);

    if($type == 'resethwid') $type = '0';
    if($type == 'resetip') $type = '1';
    //
    if($type == 'yesresethwid') $type = '2';
    if($type == 'noresethwid') $type = '3';

    $sql = "SELECT count(*) FROM qwe_requests WHERE `userid`='".$user['id']."' AND `type`='".$type."' AND `active`=1";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($res);
    $countuser = $row[0];

    if($countuser == 0) {
        
        if($type == '0') {
            $res = $con->query("SELECT count(*) FROM qwe_keys WHERE `acc_id` = '".$user['id']."'");
            $row = $res->fetch_row();
            $count = $row[0];

            if($count > 0) {
                $res = $con->query("SELECT count(*) FROM qwe_keys WHERE `activated` = 1 AND `acc_id` = '".$user['id']."'");
                $row = $res->fetch_row();
                $count = $row[0];

                if($count > 0) {
                    $res = $con->query("SELECT count(*) FROM qwe_keys WHERE `hwid` = 'Not defined' AND `acc_id` = '".$user['id']."'");
                    $row = $res->fetch_row();
                    $count = $row[0];

                    if($count == 0) {
                        $result = mysqli_query($con,"INSERT INTO `qwe_requests`(`date`, `type`, `reason`, `userid`, `username`, `active`, `ip_address`) VALUES (now(), '0','".$_GET['reasonhwid']."','".$user['id']."','".$user['name']."','1','$ip')");
                        
                        $queryasd = "SELECT * FROM qwe_keys WHERE `acc_id`='".$user['id']."'";
                        $resultasd = mysqli_query($con,$queryasd);
                        $keyinfo = mysqli_fetch_assoc($resultasd);
                        
                        if($result) {
                            $result = mysqli_query($con,"INSERT INTO `qwe_logs`(`user`, `text`, `ip_address`) VALUES ('".$user['name']."', 'запросил сброс HWID по заявке', '".$user['ip_address']."')");
                            die('YES');
                        } else {
                            die('#error Ошибка на стороне сервера. Обратитесь к администрации!');
                        }
                    } else {
                        die('#error Вы уже сбросили HWID!');
                    }
                } else {
                    die('#error Вы не активировали ключ, чтобы сбрасывать HWID!');
                }
            } else {
                die('#error Сгенерируйте ключ для сброса HWID!');
            }
        }
    } else {
        die('#error Вы уже отправили запрос на сброс! Ожидайте..');
    }
    if($type == '2') {
        $querymot = 'SELECT * FROM qwe_requests WHERE id="'.$_GET['requestid'].'"';
        $resultmot = mysqli_query($con,$querymot);
        $requser = mysqli_fetch_assoc($resultmot); 

        $querysss = 'SELECT * FROM qwe_keys WHERE acc_id="'.$requser['userid'].'"';
        $resultsss = mysqli_query($con,$querysss );
        $pidoruser = mysqli_fetch_assoc($resultsss); 

        $resultreq = mysqli_query($con,"UPDATE `qwe_requests` SET `active` = '0'  WHERE `id` = '". $_GET['requestid'] ."' AND `type`='0' AND `active`=1 LIMIT 1");
        $resultpidar = mysqli_query($con,"UPDATE `qwe_keys` SET `hwid` = 'Not defined' WHERE `acc_id` = '". $requser['userid'] ."' LIMIT 1");
        if($resultreq && $resultpidar) {
            $result = mysqli_query($con,"INSERT INTO `qwe_logs`(`user`, `text`, `ip_address`) VALUES ('".$requser['username']."', 'сбросил HWID по заявке [старый: ".$pidoruser['hwid']."]', '".$user['ip_address']."')");
            $res = mysqli_query($con,"INSERT INTO `qwe_logs`(`user`, `text`, `ip_address`) VALUES ('".$user['name']."', 'одобрил заявку на сброс HWID пользователю ".$requser['username']."', '".$user['ip_address']."')");
            die('#yes Вы успешно сбросили HWID пользователю '.$requser['username']);
        }
    } else if($type == '3') {
        $querymot = 'SELECT * FROM qwe_requests WHERE id="'.$_GET['requestid'].'"';
        $resultmot = mysqli_query($con,$querymot);
        $requser = mysqli_fetch_assoc($resultmot); 

        $resultreq = mysqli_query($con,"UPDATE `qwe_requests` SET `active` = '0'  WHERE `id` = '". $_GET['requestid'] ."' AND `type`='0' AND `active`=1 LIMIT 1");
        if($resultreq) {
            $result = mysqli_query($con,"INSERT INTO `qwe_logs`(`user`, `text`, `ip_address`) VALUES ('".$user['name']."', 'отклонил заявку на сброс HWID пользователю ".$requser['username']."', '".$user['ip_address']."')");
            die('#yes Вы успешно отклонили запрос на сброс HWID пользователю '.$requser['username']);
        }
    }
?>
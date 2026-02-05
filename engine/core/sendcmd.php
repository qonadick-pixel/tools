<?php
    include $_SERVER['DOCUMENT_ROOT']."/pages/config.php";

    $type = $_GET['type'];

    if($type == 'sendcommand') {
        $cmd = $_GET['command'];

        if(isset($cmd)) {
            $result = mysqli_query($con,"INSERT INTO `qwe_cmds`(`cmd`, `log_text`) VALUES ('".$cmd."', '0')");
            if($result) {
                echo "#success Запрос на выполнение команды от имени бота был отправлен [$cmd]";
            }
        } else {
            die('#error Вы не указали команду!');
        }
    } else if($type == 'remcommand') {
        $id = $_GET['id'];
        $textlog = $_GET['textlog'];

        if(isset($id)) {
            $result = mysqli_query($con,"UPDATE `qwe_cmds` SET `active`='0',`log_text`='$textlog' WHERE `id`=$id");
            if($result) {
                echo "OK";
            }
        } else {
            die('NOT OK');
        }
    }
?>
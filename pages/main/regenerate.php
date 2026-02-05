<?php
    session_start();
    require ("../config.php");

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

    $ip = getIp();

    $sname = $_SESSION['name'];
    $spass = $_SESSION['pass'];

	$query = "SELECT * FROM qwe_users WHERE name='".$sname."' AND pass='".$spass."'";
    $result = mysqli_query($con,$query);
    $user = mysqli_fetch_assoc($result); 

    $acid = $user['id'];

    $sql = "SELECT count(*) FROM qwe_keys WHERE `acc_id`='".$acid."'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($res);
    $countkey = $row[0];

	$query = "SELECT * FROM qwe_keys WHERE `acc_id`='".$acid."'";
    $result = mysqli_query($con,$query);
    $keyzxc = mysqli_fetch_assoc($result); 


    function random_number($length = 16)
    {
        $arr = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
            '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
        );

        $res = '';
        for ($i = 0; $i < $length; $i++) {
            $res .= $arr[random_int(0, count($arr) - 1)];
        }
        $add = '-';
        $new=substr_replace($res,$add,4,0);
        $new=substr_replace($new,$add,9,0);
        $new=substr_replace($new,$add,14,0); 
        return $new;
    }
	if($countkey == 0) {
        $new_key = random_number();
        $result = mysqli_query($con,"INSERT INTO `qwe_keys`(`key`, `acc_id`, `hwid`, `ip_address`, `last_regen`) VALUES ('$new_key', '$acid', 'Not defined', '$ip', '".time()."')");
        $result = mysqli_query($con,"INSERT INTO `qwe_logs`(`user`, `text`, `ip_address`) VALUES ('".$user['name']."', ' Сгенерировал первый ключ: <strong>$new_key</strong>','$ip')");
        die('#1newkey '.$new_key);
    } else {
        if($keyzxc['activated'] == '0') {
            $pidoras = time() - $keyzxc['last_regen'];
            if($pidoras > 3600) {
                $new_key = random_number();
                $result = mysqli_query($con,"UPDATE `qwe_keys` SET `key` = '$new_key', `last_regen` = '".time()."', `ip_address` = '$ip' WHERE `acc_id` = '$acid' LIMIT 1");
                $result = mysqli_query($con,"INSERT INTO `qwe_logs`(`user`, `text`, `ip_address`) VALUES ('".$user['name']."', ' Сгенерировал новый ключ: $new_key<br />Старый: ".$keyzxc['key']."<br />','$ip')");
                echo '#newkey '.$new_key;
            } else {
                $pidoras = 3600 - $pidoras;
                $pidoras = floor($pidoras / 60);
                die('#error Сгенерировать новый ключ вы можете не ранее чем 1 час! <br>Осталось: '.$pidoras.' минут.');
            }
        } else {
            die('#error Вы не можете сгенерировать новый ключ, так как вы активировали предыдущий');
        }
    }
?>
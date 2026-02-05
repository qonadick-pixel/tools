<?php
    require ('config.php');
    
    $name = $_GET['name'];
    $pass = $_GET['pass'];

    function check_mobile_device() { 
        $mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);    
        // var_dump($agent);exit;
        foreach ($mobile_agent_array as $value) {    
            if (strpos($agent, $value) !== false) return true;   
        }       
        return false; 
    }

    function getInfoBrowser(){
        $agent = $_SERVER['HTTP_USER_AGENT'];
        preg_match("/(MSIE|Opera|Firefox|Chrome|Version)(?:\/| )([0-9.]+)/", $agent, $bInfo);
        $browserInfo = array();
        $browserInfo['name'] = ($bInfo[1]=="Version") ? "Safari" : $bInfo[1];
        $browserInfo['version'] = $bInfo[2];     
        return $browserInfo;
    }
    
    $browser = getInfoBrowser();
    $browser = $browser['name']. ' '.$browser['version'];

    $is_mobile_device = check_mobile_device();
    if($is_mobile_device) $device = 'Mobile';
    else $device = 'PC';
    
	$query = "SELECT * FROM qwe_users WHERE name='".$name."' AND pass='".$pass."'";
    $result = mysqli_query($con,$query);
    $user = mysqli_fetch_assoc($result);

    $sql = "SELECT count(*) FROM qwe_users WHERE name='".$name."' AND pass='".$pass."'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($res);
    $countuser = $row[0];

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

    date_default_timezone_set('Europe/Moscow');
    $ip = getIp();
    $date = date("Y-m-d H:i:s");
    
	if($countuser == 0) {
		die('#Ошибка Вы ввели неверный логин или пароль');
	}
    if($user['active_acc'] == 0) {
        die('#Ошибка Ваш аккаунт не активирован! Проверьте почту');
    }

    function get_mesto($ipget) {
        $mesto = file_get_contents('http://ip-api.com/php/'.$ipget.'?fields=61439&lang=ru');
        $mesto = unserialize($mesto);
        return $mesto['country'].' | '.$mesto['city'];
    }
    
    session_start(); 
    setcookie('user', $fet['name'], time() +3600 * 24);
    
    $_SESSION['auth'] = true; 
    $_SESSION['ID'] = $user['id']; 
    
    $_SESSION['name'] = $name;
    $_SESSION['pass'] = $pass;

    $result = mysqli_query($con,"UPDATE `qwe_users` SET `date_last_join` = now(), `last_ip` = '$ip' WHERE `id` = '".$user['id']."' LIMIT 1");
    $resulttwo = mysqli_query($con,"INSERT INTO `qwe_joinlogs`(`userid`, `mesto`, `device`, `last_ip`, `reg_ip`, `browser`) VALUES ('".$user['id']."', '".get_mesto($ip)."', '$device','$ip','".$user['ip_address']."', '".$browser."')");
    
    die('YES');
    mysqli_close($con);
?>
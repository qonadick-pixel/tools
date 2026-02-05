<?
    session_start();
    
    include ("./pages/config.php");
    include ("./engine/smtp_mailer.php");
    
    $sname = $_SESSION['name'];
    $spass = $_SESSION['pass'];

    $ip = $_SERVER['REMOTE_ADDR'];
    
	$query = "SELECT * FROM qwe_users WHERE name='".$sname."' AND pass='".$spass."'";
    $result = mysqli_query($con,$query);
    $user = mysqli_fetch_assoc($result); 

    $acid = $user['id'];

	$query = "SELECT * FROM qwe_keys WHERE `acc_id`='".$acid."'";
    $result = mysqli_query($con,$query);
    $keyzxc = mysqli_fetch_assoc($result); 

    $sql = "SELECT count(*) FROM qwe_keys WHERE `acc_id`='".$acid."'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($res);
    $countkey = $row[0];

	if($countkey == 0) {
        $my_key = 'Не сгенерирован';
    } else {
        $my_key = $keyzxc['key'];
    }
    
	$action = stripslashes(htmlspecialchars(trim($_GET['action'])));

    function getUserById($userid, $con)
    {
        $queryzxc = 'SELECT * FROM qwe_users WHERE id="'.$userid.'"';

        $resultzxc = mysqli_query($con,$queryzxc);
        $penissigma = mysqli_fetch_assoc($resultzxc); 
        if($penissigma) {
            return $penissigma['name'];
        } else {
            return 'Не определено';
        }
    }
	
	$url = explode('/', $action);

    function get_mesto($ipget) {
        $mesto = file_get_contents('http://ip-api.com/php/'.$ipget.'?fields=61439&lang=ru');
        $mesto = unserialize($mesto);
        return $mesto['country'].' | '.$mesto['city'];
    }

    function check_mobile_device() { 
        $mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);    
        // var_dump($agent);exit;
        foreach ($mobile_agent_array as $value) {    
            if (strpos($agent, $value) !== false) return true;   
        }       
        return false; 
    }

    if(empty($url[0]))
    {
        $title = 'Главная';
        $page = 'pages/index.php';
        $negr = true;
        return false;
    }
    if($url[0] == 'errors') {
        $title = 'Решение ошибок';
        $page = 'pages/errors.php';
        $negr = true;
        return false;
    }
    if($url[0] == 'install') {
        $title = 'Установка';
        $page = 'pages/install.php';
        $negr = true;
        return false;
    }
    if($url[0] == 'login')
    {
        if(!$_SESSION['auth']) {
            $title = 'Авторизация';
            $page = 'pages/login.php';
            $negr = true;
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }
    if($url[0] == 'recovery') {
        if(!$_SESSION['auth']) {
            $title = 'Восстановление пароля'; 
            $page = 'pages/forgotpass.php';
            $negr = true;
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }
    if($url[0] == 'register')
    {
        if(!$_SESSION['auth']) {
            $title = 'Регистрация'; 
            $page = 'pages/register.php';
            $negr = true;
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }
    if($url[0] == 'logout')
    {
        if($_SESSION['auth']) {
            $title = 'Выход';
            $page = 'pages/main/logout.php'; 
            $negr = false;
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }
    if($url[0] == 'settings')
    {
        if($_SESSION['auth']) {
            $title = 'Настройки';
            $page = 'pages/main/settings.php'; 
            $negr = false;
            $script = '<script src="/js/modal.js"></script>
            <script src="/js/app.js"></script>
            <script src="/js/move.js"></script>
            <script src="/js/dropdownMneuSel.js"></script>';
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            $script = '<script src="/js/modal.js"></script>
            <script src="/js/app.js"></script>';
            return false;
        }
    }
    if($url[0] == 'profile')
    {
        if($_SESSION['auth']) {
            $title = 'Профиль';
            $page = 'pages/main/profile.php'; 
            $negr = false;
            $script = '<script src="/js/modal.js"></script>
            <script src="/js/app.js"></script>
            <script src="/js/move.js"></script>';
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }
    if($url[0] == 'keys')
    {
        if($_SESSION['auth'] && $user['status'] != 'user') {
            $title = 'Ключи';
            $page = 'pages/main/keys.php';
            $negr = false;
            $admin = true;
            $script = '<script src="/js/modal.js"></script>
            <script src="/js/app.js"></script>
            <script src="/js/move.js"></script>
            <script src="/js/dropdownMneuSel.js"></script>';
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }
    if($url[0] == 'logs')
    {
        if($_SESSION['auth'] && $user['status'] != 'user') {
            $title = 'Логи';
            $page = 'pages/main/logs.php';
            $negr = false;
            $admin = true;
            $script = '<script src="/js/modal.js"></script>
            <script src="/js/app.js"></script>
            <script src="/js/move.js"></script>
            <script src="/js/dropdownMneuSel.js"></script>';
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }
    if($url[0] == 'keyusers')
    {
        if($_SESSION['auth'] && $user['status'] != 'user') {
            $title = 'Пользователи скрипта';
            $page = 'pages/main/users_script.php';
            $negr = false;
            $admin = true;
            $script = '<script src="/js/modal.js"></script>
            <script src="/js/app.js"></script>
            <script src="/js/move.js"></script>
            <script src="/js/dropdownMneuSel.js"></script>';
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }
    if($url[0] == 'siteusers')
    {
        if($_SESSION['auth'] && $user['status'] != 'user') {
            $title = 'Пользователи сайта';
            $page = 'pages/main/users_site.php';
            $negr = false;
            $admin = true;
            $script = '<script src="/js/modal.js"></script>
            <script src="/js/app.js"></script>
            <script src="/js/move.js"></script>
            <script src="/js/dropdownMneuSel.js"></script>';
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }

    if($url[0] == 'hwidrequests')
    {
        if($_SESSION['auth'] && $user['status'] != 'user') {
            $title = 'Запросы на сброс HWID';
            $page = 'pages/main/request_hwid.php';
            $negr = false;
            $admin = true;
            $script = '<script src="/js/modal.js"></script>
            <script src="/js/app.js"></script>
            <script src="/js/move.js"></script>
            <script src="/js/dropdownMneuSel.js"></script>';
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }

    if($url[0] == 'stats')
    {
        if($_SESSION['auth']) {
            $title = 'Статистика';
            $page = 'pages/main/stats.php'; 
            $negr = false;
            $script = '<script src="/js/modal.js"></script>
            <script src="/js/app.js"></script>
            <script src="/js/move.js"></script>';
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }

    if($url[0] == 'bot')
    {
        if($_SESSION['auth']) {
            $title = 'Бот';
            $page = 'pages/main/bot.php'; 
            $negr = false;
            $script = '<script src="/js/modal.js"></script>
            <script src="/js/app.js"></script>
            <script src="/js/move.js"></script>';
            return false;
        } else {
            $title = 'Главная';
            $page = 'pages/index.php';
            $negr = true;
            return false;
        }
    }

	function translit($str) {
		$rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
		$lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
		return str_replace($rus, $lat, $str);
	}
?>
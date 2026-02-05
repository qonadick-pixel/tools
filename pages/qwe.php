<?php
    if(!$title == 'Главная') {
        if(!$user || $_SESSION['auth'] == false) {
            header('Location: /');
            exit();
        } else {
            header('Location: /login');
            exit();
        }
    }
    if($title == 'Главная') {
        echo '
        <style>
        .link__main:before {content: ""; height: 2px; background-color: #6B73FF; width: 100%; position: absolute; bottom: 0; left: 0; transform: scaleX(1) !important}
        .link__main {color: #6B73FF;}
        </style>';
    }elseif($title == 'Решение ошибок') {
        echo '
        <style>
        .link__errors:before {content: ""; height: 2px; background-color: #6B73FF; width: 100%; position: absolute; bottom: 0; left: 0; transform: scaleX(1) !important}
        .link__errors {color: #6B73FF;}
        </style>';
    }elseif($title == 'Установка') {
        echo '
        <style>
        .link__install:before {content: ""; height: 2px; background-color: #6B73FF; width: 100%; position: absolute; bottom: 0; left: 0; transform: scaleX(1) !important}
        .link__install {color: #6B73FF;}
        </style>';
    }
    if($title == 'Профиль') {
        echo '
        <style>
            .profile-block-active {
                background-color: rgb(107,115,255, 0.2) !important;
            }
        </style>';
    } elseif($title == 'Настройки') {
        echo '
        <style>
            .settings-block-active {
                background-color: rgb(107,115,255, 0.2) !important;
            }
        </style>';
    } elseif($title == 'Ключи') {
        echo '
        <style>
            .keys-block-active {
                background-color: rgb(107,115,255, 0.2) !important;
            }
        </style>';
    } elseif($title == 'Пользователи скрипта' || $title == 'Пользователи сайта') {
        echo '
        <style>
            .users-block-active {
                background-color: rgb(107,115,255, 0.2) !important;
            }
        </style>';
    } elseif($title == 'Логи') {
        echo '
        <style>
            .logs-block-active {
                background-color: rgb(107,115,255, 0.2) !important;
            }
        </style>';
    } elseif($title == 'Запросы на сброс HWID' || $title == 'Запросы на сброс IP-адреса') {
        echo '
        <style>
            .requests-block-active {
                background-color: rgb(107,115,255, 0.2) !important;
            }
        </style>';
    } elseif($title == 'Статистика') {
        echo '
        <style>
            .statistic-block-active {
                background-color: rgb(107,115,255, 0.2) !important;
            }
        </style>';
    } elseif($title == 'Бот') {
        echo '
        <style>
            .bot-block-active {
                background-color: rgb(107,115,255, 0.2) !important;
            }
        </style>';
    }
?>

<!DOCTYPE html>
<html lang="ru">
	<head> 
        <?php
            echo '
            <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
            <meta charset="UTF-8">
            <title>'.$title.' — Grand Tools</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">';
        
            if($page == 'pages/index.php' || $page == 'pages/errors.php' || $page == 'pages/install.php') { echo '
                <link rel="stylesheet" href="/css/main.css?'.time().'">
                <link rel="stylesheet" href="/css/index.css?'.time().'">
                <link rel="stylesheet" href="/css/bar.css?'.time().'">
                <link rel="stylesheet" href="/css/app.css?'.time().'">';
            } else if($title == 'Авторизация' || $title == 'Регистрация' || $title == 'Восстановление пароля' ) { echo '
                <link rel="stylesheet" href="/css/main.css?'.time().'">
                <link rel="stylesheet" href="/css/login.css?'.time().'">';
            } else if($title == 'Бот' || $title == 'Статистика' || $title == 'Запросы на сброс IP-адреса' || $title == 'Запросы на сброс HWID' || $title == 'Пользователи скрипта' || $title == 'Пользователи сайта' || $title == 'Ключи' || $title == 'Логи') {  echo '
                <link rel="stylesheet" href="/css/app.css?'.time().'">
                <link rel="stylesheet" title="menu" href="#">';
            } else if($title == 'Профиль') { echo '
                <link rel="stylesheet" href="/css/app.css?'.time().'">
                <link rel="stylesheet" href="/css/user_acc.css?'.time().'">
                <link rel="stylesheet" title="menu" href="#">';
            } else if($title == 'Настройки') { echo '
                <link rel="stylesheet" href="/css/settings.css?'.time().'">
                <link rel="stylesheet" href="/css/app.css?'.time().'">
                <link rel="stylesheet" title="menu" href="#">';
            }
            echo '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script src="https://www.google.com/recaptcha/api.js"></script>
            <script src="/js/modal.js?'.time().'"></script>

            <!-- Preloader -->
            <link rel="stylesheet" href="/css/preload.css?'.time().'">

            <!-- Favicon -->
            <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
            <script src="/js/dist/simple-notify.min.js"></script>
            <link rel="stylesheet" title="theme" href="/css/themes/dark.css">
            <meta name="msapplication-TileColor" content="#d40d0d" />
            <meta name="theme-color" content="#ffffff" />
            <link rel="stylesheet" href="/css/font-awesome.min.css">
            <script src="https://kit.fontawesome.com/60ffe1824d.js" crossorigin="anonymous"></script>

            <!-- Notifications -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8"></script>
            <link rel="stylesheet" href="/js/dist/simple-notify.min.css" />

            <link rel="stylesheet" href="/css/datatables.css">
            <script src="/js/datatables/jquery.dataTables.js"></script>

            
            <link href="https://cdn.jsdelivr.net/gh/Alaev-Co/snowflakes/dist/snow.min.css" rel="stylesheet">
            

            <style>
            html {
                scrollbar-color: #6B73FF #222222;
            }
            </style>
            
            ';
        ?>
	</head>
	<body id="body">
        <?php require_once 'pages/preload/preload.php'; ?>
        <div class="app_body" id="app_body" style="z-index: 1">
            <?php require_once $page; ?>
            <style>
                .modal-content-head {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                .users-dropdown {
                    transition: all .25s ease-in-out;
                    background: none;
                }
            </style>
            <script type="text/javascript">
            function play() {
                var snd = new Audio("/assets/sound/notify.mp3");
                snd.play()
                snd.currentTime=0
            }
            $(document).ready(function(){
                $('#regenerate').click(function(){
                    $.ajax({
                        type: 'POST',
                        url: '/pages/main/regenerate.php',
                        success: function(data) {
                            if (data.search('#newkey') != -1) {

                                data = data.replace('#newkey', ''); 

                                new Notify ({
                                    title: 'Успешно',
                                    text: 'Вы успешно сгенерировали новый ключ',
                                    status: 'success', 
                                    autoclose: true,
                                    autotimeout: 2000                    
                                }) 
                                data = data.substring(1);
                                document.getElementById("zxckey").setAttribute("value", data);
                                play()

                                /*var audio = new Audio('/assets/sound/notify.mp3');
                                audio.play();*/
                            } else if (data.search('#error') != -1) {

                                data = data.replace('#error', ''); 

                                new Notify ({
                                    title: 'Ошибка',
                                    text: data,
                                    status: 'error', 
                                    autoclose: true,
                                    autotimeout: 2000                    
                                }) 
                                play()
                            } else if (data.search('#1newkey') != -1) {

                                data = data.replace('#1newkey', ''); 
                                data = data.substring(1);

                                new Notify ({
                                    title: 'Успешно',
                                    text: 'Вы успешно создали новый ключ',
                                    status: 'success', 
                                    autoclose: true,
                                    autotimeout: 2000                    
                                }) 
                                document.getElementById("zxckey").setAttribute("value", data);
                                play()
                            }
                        }
                    });
                });
            });

            $(document).ready(function(){
                $('#logout').click(function(){
                    $.ajax({
                        type: 'POST',
                        url: '/pages/main/logout.php',
                        success: function(data) {

                            new Notify ({
                                title: 'Успешно',
                                text: 'Вы успешно вышли с аккаунта',
                                status: 'success', 
                                autoclose: true,
                                autotimeout: 2000                    
                            }) 
                            play()
                            setInterval(() => {
                                window.location = "/"
                            }, 500);
                        }
                    });
                });
            });
            </script>
        </div>

    <script src="https://cdn.jsdelivr.net/gh/Alaev-Co/snowflakes/dist/Snow.min.js"></script>

	<script>
		new Snow ({
            snowPlowImage: false,
            showSnowBalls: false,
        });
	</script>
	</body>
    <script src="/js/preload.js"></script>
    <script>
        var table = new DataTable('#filter__table', {
            language: {
                url: '/assets/ru.json',
            },
        });

    </script>
    <?php if(isset($script)) echo $script ?>
</html>
<?php 
    // include $_SERVER['DOCUMENT_ROOT']."/pages/config.php";

    if(isset($_SESSION['name'])) {
        $query = "SELECT * FROM `qwe_users` WHERE `name`='".$_SESSION['name']."'";
        $sql = mysqli_query($con,$query) or die(mysqli_error());
        $myrow = mysqli_fetch_array($sql);
        
        $pidoras = time() - $myrow['telegram_modal_date'];
        if($pidoras > 1800) {
            require_once 'pages/modals/telegram_link.php' ;
            $sql = $con->query("UPDATE `qwe_users` SET `telegram_modal_date` = '".time()."' WHERE `name`='".$_SESSION['name']."'");
        }
    } else {
        require_once 'pages/modals/telegram_link.php' ;
    }
?>
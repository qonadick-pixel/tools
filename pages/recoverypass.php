<?php
    session_start();
    require 'config.php';
    
    if ($_GET['hash']) {
        $hash = $_GET['hash'];
        $_SESSION['hash123'] = $hash;

        $sql = "SELECT count(*) FROM qwe_users WHERE `hash_pass`='".$hash."'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($res);
        $countuser = $row[0];

        if($countuser != 0) {
            if($result = mysqli_query($con, "SELECT `id` FROM `qwe_users` WHERE `hash_pass`='" . $hash . "'")) {
                while($row = mysqli_fetch_assoc($result)) { 
                    echo '
                    <body>
                        <div class="main" id="main">
                            <form class="form" id="recoverypass">
                
                                <div class="form__title">
                                    <a href="/" class="form__title_link" style="font-size: 30px;">Grand Tools</a>
                                </div>
                
                                <div class="form__group">
                                    <input class="form__input input__pass" placeholder=" " type="password" id="pass" name="pass">
                                    <label for="pass" class="form__label">Новый пароль</label>
                                    <div class="form__eye">
                                        <i class="fa-regular fa-eye open_eye" style="display: none"></i>
                                        <i class="fa-solid fa-eye-slash close_eye" style="color: gray"></i>
                                    </div>
                                </div>

                                <div class="form__group">
                                    <input class="form__input input__passs" placeholder=" " type="password" id="passtwo" name="passtwo">
                                    <label for="passtwo" class="form__label">Подтвердите пароль</label>
                                    <div class="form__eyee">
                                        <i class="fa-regular fa-eye open_eyee" style="display: none"></i>
                                        <i class="fa-solid fa-eye-slash close_eyee" style="color: gray"></i>
                                    </div>
                                </div>
                                    
                                <!--<div class="form__group" style="margin-bottom: 15px">
                                    <div class="g-recaptcha" data-sitekey="<?php echo Config::RECAPTCHA_KEY ?>"></div>
                                </div>-->
                                <div class="form__footer">
                                    <button class="form__button" onclick="recovery()">Изменить</button>
                                </div>
                                
                
                            </form>
                        </div>
                    </body>
                    <script src="/js/preload.js"></script>';
                }
            } else {
                echo "<center>Что-то пошло не так, обратитесь к администрации!</center>";
            }
        } else {
            echo '<center style="color: #fff;"><h1>Вы уже делали восстановление по данной ссылке!</h1></center>';
        }
    } else {
        echo "<center>Что-то пошло не так, обратитесь к администрации!</center>";
    }
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
        <meta charset="UTF-8">
        <title>Подтверждение — Grand Tools</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/login.css">
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script src="https://kit.fontawesome.com/60ffe1824d.js" crossorigin="anonymous"></script>
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <meta name="msapplication-TileColor" content="#d40d0d" />
        <meta name="theme-color" content="#ffffff" />

        <link rel="stylesheet" href="/css/font-awesome.min.css">

        <link href="https://cdn.jsdelivr.net/gh/Alaev-Co/snowflakes/dist/snow.min.css" rel="stylesheet">

        <!-- Notifications -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8"></script>
        <link rel="stylesheet" href="/js/dist/simple-notify.min.css" />
        <script src="/js/dist/simple-notify.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/preload.css">
        <style>
            body {
                background-color: #1D1C24;
            }
        </style>
	</head>

    <script>
        let openEyee = document.querySelector('.open_eyee'),
            closeEyee = document.querySelector('.close_eyee'),
            inputPasss = document.querySelector('.input__passs'),
            formEyee = document.querySelector('.form__eyee')

        formEyee.onclick = function() {
            if (inputPasss.getAttribute('type') === 'password') {
                inputPasss.setAttribute('type', 'text')
                openEyee.style.setProperty("display", "block")
                closeEyee.style.setProperty("display", "none")
            } else {
                inputPasss.setAttribute('type', 'password')
                openEyee.style.setProperty("display", "none")
                closeEyee.style.setProperty("display", "block")
            }
        }
    </script>
    <script>
        let openEye = document.querySelector('.open_eye'),
            closeEye = document.querySelector('.close_eye'),
            inputPass = document.querySelector('.input__pass'),
            formEye = document.querySelector('.form__eye')

        formEye.onclick = function() {
            if (inputPass.getAttribute('type') === 'password') {
                inputPass.setAttribute('type', 'text')
                openEye.style.setProperty("display", "block")
                closeEye.style.setProperty("display", "none")
            } else {
                inputPass.setAttribute('type', 'password')
                openEye.style.setProperty("display", "none")
                closeEye.style.setProperty("display", "block")
            }
        }
    </script>
    <script>
    function play() {
        var snd = new Audio("/assets/sound/notify.mp3");
        snd.play()
        snd.currentTime=0
    }

    function recovery()
    {
        var pass = document.getElementById("pass").value;
        var repeat = document.getElementById("passtwo").value;
        var response = grecaptcha.getResponse();
        if(response.length == 0) {
            new Notify ({
                title: 'Ошибка',
                text: "Подтвердите, что вы не робот",
                status: 'error',
                autoclose: true,
                autotimeout: 2000                    
            })

            play()

            event.preventDefault();
            return false;
        }
        if(repeat.length == 0 || pass.length == 0)
            {
                new Notify ({
                    title: 'Ошибка',
                    text: 'Необходимо заполнить все поля!',
                    status: 'error', 
                    autoclose: true,
                    autotimeout: 2000                    
                })
                play()
                event.preventDefault();
                return false;                        
            }
        if(pass != repeat)
        {
            new Notify ({
                title: 'Ошибка',
                text: 'Введенные вами пароли не совпадают!',
                status: 'error', 
                autoclose: true,
                autotimeout: 2000                    
            })
            play()
            event.preventDefault();
            return false;                        
        } 
        if(pass.length < 5 || pass.length > 31) {
                new Notify ({
                    title: 'Ошибка',
                    text: 'Длина пароля должна быть минимум 6 и не более 30 символов!',
                    status: 'error', 
                    autoclose: true,
                    autotimeout: 2000                    
                })
                play()
                event.preventDefault();
                return false;   
            }
    }

    $("#recoverypass").on('submit', function(e) {    
        e.preventDefault();

        $.ajax({
            type:'GET',
            url: '/pages/editpass.php?type=recoverypass',
            data: $('#recoverypass').serialize(),
            cache: false,
            success: function(data) { 
                if (data.search('#Ошибка') != -1) {
                    data = data.replace('#Ошибка', ''); 
                    play()
                    
                    new Notify ({
                        title: 'Ошибка',
                        text: data,
                        status: 'error',
                        autoclose: true,
                        autotimeout: 2000                    
                    }) 
                    
                    // event.preventDefault();
                    return false;             
                }
                else if (data == 'YES') {
                    new Notify ({
                        title: 'Успешно',
                        text: "Вы успешно сменили пароль!",
                        status: 'success',
                        autoclose: true,
                        autotimeout: 2000                    
                    }) 
                    play()

                    setInterval(() => {
                        window.location = "/login"
                    }, 2000);
                }
            }
        });
    });    
    </script>
    <script src="https://cdn.jsdelivr.net/gh/Alaev-Co/snowflakes/dist/Snow.min.js"></script>
	<script>
		new Snow ({
            snowPlowImage: false,
            showSnowBalls: false,
        });
	</script>
    <?php require_once 'pages/preload/preload.php'; ?>
</html>
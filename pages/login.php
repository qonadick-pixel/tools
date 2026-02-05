<?php require_once 'config.php' ?>

<div class="main" id="main">
    <form class="form" id="autorization">

        <div class="form__title">
            <a href="/" class="form__title_link" style="font-size: 40px;">Grand Tools</a>
        </div>
        <div class="form__note">
            <p>Нет аккаунта? <a href="register" class="form__link">Создать аккаунт</a></p>
        </div>

        <div class="form__group">
            <input class="form__input" placeholder=" " type="name" id="logname" name="name">
            <label for="logname" class="form__label">Логин</label>
        </div>

        <div class="form__group">
            <input class="form__input input__pass" placeholder=" " type="password" id="logpass" name="pass">
            <label for="logpass" class="form__label">Пароль</label>
            <div class="form__eye">
                <i class="fa-regular fa-eye open_eye" style="display: none"></i>
                <i class="fa-solid fa-eye-slash close_eye" style="color: gray"></i>
            </div>
            <a href="recovery" class="form__links">Забыли пароль?</a>
        </div>

        <div class="form__group" style="margin-bottom: 15px">
            <div class="g-recaptcha" data-sitekey="<?php echo Config::RECAPTCHA_KEY ?>"></div>
        </div>

        <div class="form__footer">
            <button class="form__button" onclick='login()'>Войти</button>
        </div>

    </form>
</div>
<script>
    let openEye = document.querySelector('.open_eye'),
        closeEye = document.querySelector('.close_eye'),
        inputPass = document.querySelector('.input__pass'),
        formEye = document.querySelector('.form__eye')

    formEye.onclick = function () {
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
        snd.currentTime = 0
    }


    function login() {
        var name = document.getElementById("logname").value;
        var pass = document.getElementById("logpass").value;
        var response = grecaptcha.getResponse();

        if (response.length == 0) {
            new Notify({
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
        if (name.length == 0 || pass.length == 0) {
            new Notify({
                title: 'Ошибка',
                text: "Заполните все поля!",
                status: 'error',
                autoclose: true,
                autotimeout: 2000
            })

            play()

            event.preventDefault();
            return false;
        }
    }

    $("#autorization").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'GET',
            url: '/pages/prelogin.php',
            data: $('#autorization').serialize(),
            cache: false,
            success: function (data) {
                if (data.search('#Ошибка') != -1) {
                    data = data.replace('#Ошибка', '');
                    play()

                    new Notify({
                        title: 'Ошибка',
                        text: data,
                        status: 'error',
                        autoclose: true,
                        autotimeout: 2000
                    })

                    event.preventDefault();
                    return false;
                }
                else if (data == 'YES') {
                    new Notify({
                        title: 'Успешно',
                        text: 'Вы успешно авторизовались в систему!',
                        status: 'success',
                        autoclose: true,
                        autotimeout: 2000
                    })
                    play()

                    setInterval(() => {
                        window.location = "/profile"
                    }, 500);
                }
            }
        });
    });    
</script>

<!--<script src="/js/three.min.js"></script>
        <script src="/js/vanta.net.min.js"></script>
        <script>
            VANTA.NET({
            el: "#main",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x823fff
        })
        </script>-->
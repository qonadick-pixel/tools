        <?php require_once 'config.php' ?>
        
        <div class="main" id="main">
            <form class="form" id="register">

                <div class="form__title">
                    <a href="/" class="form__title_link" style="font-size: 30px;">Grand Tools</a>
                </div>
                <div class="form__note">
                    <p>Есть аккаунт? <a href="login" class="form__link">Войти</a></p>
                </div>

                <div class="form__group">
                    <input class="form__input" placeholder=" " type="name" id="logemail" name="le">
                    <label for="logemail" class="form__label">Почта</label>
                </div>

                <div class="form__group">
                    <input class="form__input" placeholder=" " type="name" id="logname" name="ln">
                    <label for="logname" class="form__label">Логин</label>
                </div>

                <div class="form__group">
                    <input class="form__input input__pass" placeholder=" " type="password" id="logpass" name="lp">
                    <label for="logpass" class="form__label">Пароль</label>
                    <div class="form__eye">
                        <i class="fa-regular fa-eye open_eye" style="display: none"></i>
                        <i class="fa-solid fa-eye-slash close_eye" style="color: gray"></i>
                    </div>
                </div>

                <div class="form__group">
                    <input class="form__input input__passs" placeholder=" " type="password" id="logrepeatpass" name="lrp">
                    <label for="logrepeatpass" class="form__label">Повторите пароль</label>
                    <div class="form__eyee">
                        <i class="fa-regular fa-eye open_eyee" style="display: none"></i>
                        <i class="fa-solid fa-eye-slash close_eyee" style="color: gray"></i>
                    </div>
                </div>

                <div class="form__group" style="margin-bottom: 15px">
                    <div class="g-recaptcha" data-sitekey="<?php echo Config::RECAPTCHA_KEY ?>"></div>
                </div>

                <div class="form__footer">
                    <button class="form__button" onclick='register()'>Зарегистрироваться</button>
                </div>

            </form>
        </div>
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
        <script>
        function play() {
            var snd = new Audio("/assets/sound/notify.mp3");
            snd.play()
            snd.currentTime=0
        }
        function register()
        {
            var ln = document.getElementById("logname").value;
            var le = document.getElementById("logemail").value;
            var lp = document.getElementById("logpass").value;
            var lrp = document.getElementById("logrepeatpass").value;         
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
            if(ln.length == 0 || le.length == 0 || lp.length == 0 || lrp.length == 0)
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
            if(lp.length < 5 || lp.length > 31) {
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
            if(lp != lrp)
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
        }
        $("#register").on('submit', function(e) {    
            e.preventDefault();
            
            $.ajax({
                type:'GET',
                url: '/pages/prereg.php',
                data: $('#register').serialize(),
                cache: false,
                success: function(data) { 
                    if (data.search('#Ошибка') != -1) {
                        data = data.replace('#Ошибка', ''); 
                        /// play()
                        
                        new Notify ({
                            title: 'Ошибка',
                            text: data,
                            status: 'error',
                            autoclose: true,
                            autotimeout: 2000                    
                        }) 
                        play()
                        event.preventDefault();
                        return false;             
                    }
                    else if (data.search('YES') != -1) {
                        play()
                        new Notify ({
                            title: 'Успешно',
                            text: "Вы успешно зарегистрировались! Проверьте почту",
                            status: 'success',
                            autoclose: true,
                            autotimeout: 2000                    
                        }) 

                        setInterval(() => {
                            window.location = "/login"
                        }, 2000);
                    }
                }
            });
        });    
        </script>
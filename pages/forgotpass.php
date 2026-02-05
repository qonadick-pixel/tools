        <?php require_once 'config.php' ?>
        
        <div class="main" id="main">
            <form class="form" id="forgotpass">

                <div class="form__title">
                    <a href="/" class="form__title_link" style="font-size: 30px;">Grand Tools</a>
                </div>
                <div class="form__note">
                    <p>Нет аккаунта? <a href="register" class="form__link">Создать аккаунт</a></p>
                </div>
                <div class="form__note">
                    <p>Есть аккаунт? <a href="login" class="form__link">Войти</a></p>
                </div>

                <div class="form__group">
                    <input class="form__input" placeholder=" " type="email" id="logname" name="name">
                    <label for="logname" class="form__label">Почта</label>
                </div>
                    
                <!--<div class="form__group" style="margin-bottom: 15px">
                    <div class="g-recaptcha" data-sitekey="<?php echo Config::RECAPTCHA_KEY ?>"></div>
                </div>-->
                <div class="form__footer">
                    <button class="form__button" onclick='login()'>Напомнить</button>
                </div>
                

            </form>
        </div>
        
        <script>
        function play() {
            var snd = new Audio("/assets/sound/notify.mp3");
            snd.play()
            snd.currentTime=0
        }



        function login()
        {
            var name = document.getElementById("logname").value;
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
            if(name < 8)
            {
                new Notify ({
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

        $("#forgotpass").on('submit', function(e) {    
            e.preventDefault();

            $.ajax({
                type:'GET',
                url: '/pages/sendpass.php',
                data: $('#forgotpass').serialize(),
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
                            text: "Ссылка с восстановлением была отправлена на вашу почту!",
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
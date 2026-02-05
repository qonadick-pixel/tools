<div class="modal modal-change-password">
    <div class="modal-content">
        <div class="mc-header" style="text-align: center">
            <div class="mch-close">
                <i class="fa-solid fa-xmark mchc-close" onclick="openModalChangePassword()"></i>
            </div>
            <div class="mch-header" style="margin-bottom: 20px">
                <a>Изменение пароля</a>
            </div>
            <div class="mch-footer">
                <form class="form" id="changepass">
                    <div class="form__note">
                        <p>Проверьте папку спам, <a class="form__link">если не видите код</a></p>
                    </div>

                    <div class="form__group">
                        <input class="form__input input__pass" placeholder="" type="password" id="passone" name="passone">
                        <label for="logname" class="form__label">Введите старый пароль</label>
                        <div class="form__eye">
                            <i class="fa-regular fa-eye open_eye" style="display: none"></i>
                            <i class="fa-solid fa-eye-slash close_eye" style="color: gray"></i>
                        </div>
                    </div>

                    <div class="form__group">
                        <input class="form__input input__passs" placeholder="" type="password" id="pass" name="pass">
                        <label for="logname" class="form__label">Введите новый пароль</label>
                        <div class="form__eyee">
                            <i class="fa-regular fa-eye open_eyee" style="display: none"></i>
                            <i class="fa-solid fa-eye-slash close_eyee" style="color: gray"></i>
                        </div>
                    </div>

                    <div class="form__group">
                        <input class="form__input input__passss" placeholder="" type="password" id="passtworep" name="passtworep">
                        <label for="logname" class="form__label">Повторите новый пароль</label>
                        <div class="form__eyeee">
                            <i class="fa-regular fa-eye open_eyeee" style="display: none"></i>
                            <i class="fa-solid fa-eye-slash close_eyeee" style="color: gray"></i>
                        </div>
                    </div>

                    <div class="form__group" style="">
                        <input class="form__input" placeholder="" type="password" id="codepass" name="codepass">
                        <label for="logname" class="form__label">Введите код из письма</label>
                        <div class="form__button send_btn" id="sendMailpass" style="position: absolute; right: 20px; font-size 8px !important;">Отправить</div>
                    </div>
                </form>

                <div class="form__footer">
                    <button class="btn__choose btn__modal" id="editpass">изменить</button>
                    <button class="btn__choose btn__modal btn_margin__left_form" onclick="openModalChangePassword()">отмена</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
    let openEyeee = document.querySelector('.open_eyeee'),
        closeEyeee = document.querySelector('.close_eyeee'),
        inputPassss = document.querySelector('.input__passss'),
        formEyeee = document.querySelector('.form__eyeee')

    formEyeee.onclick = function() {
        if (inputPassss.getAttribute('type') === 'password') {
            inputPassss.setAttribute('type', 'text')
            openEyeee.style.setProperty("display", "block")
            closeEyeee.style.setProperty("display", "none")
        } else {
            inputPassss.setAttribute('type', 'password')
            openEyeee.style.setProperty("display", "none")
            closeEyeee.style.setProperty("display", "block")
        }
    }
</script>
<script>
    function play() {
        var snd = new Audio("/assets/sound/notify.mp3");
        snd.play()
        snd.currentTime=0
    }

    let sendBtn = document.querySelector('.send_btn')
    $(document).ready(function(){
        $('#sendMailpass').click(function(){
            $.ajax({
                type: 'GET',
                url: '/pages/sendmail.php?type=changepass',
                success: function(data) {
                    if (data.search('#mailsent') != -1) {

                        sendBtn.classList.add('active')

                        data = data.replace('#mailsent', ''); 
                        new Notify ({
                            title: 'Успешно',
                            text: data,
                            status: 'success',
                            autoclose: true,
                            autotimeout: 2000                    
                        })

                        play()
                    } else if (data.search('#error') != -1) {

                        sendBtn.classList.remove('active')

                        data = data.replace('#error', ''); 
                        new Notify ({
                            title: 'Ошибка',
                            text: data,
                            status: 'error',
                            autoclose: true,
                            autotimeout: 2000                    
                        })

                        play()
                    }
                }
            });
        });
    });
    $(document).ready(function(){
        $('#editpass').click(function(){
            var pass = $("#pass").val();
            var passold = $("#passone").val();
            var repeat = $("#passtworep").val();
            var codepass = $("#codepass").val();
            if(passold.length == 0 || pass.length == 0 || repeat.length == 0)
            {
                new Notify ({
                    title: 'Ошибка',
                    text: "Заполните поля, чтобы изменить пароль!",
                    status: 'error',
                    autoclose: true,
                    autotimeout: 2000                    
                })

                play();

                event.preventDefault();
                return false;                         
            }
            if(codepass.length == 0) {
                new Notify ({
                    title: 'Ошибка',
                    text: "Вы не ввели код с почты, для смены пароля!",
                    status: 'error',
                    autoclose: true,
                    autotimeout: 2000                    
                })

                play();

                event.preventDefault();
                return false;   
            }
            if(pass == passold)
            {
                new Notify ({
                    title: 'Ошибка',
                    text: 'Ваш новый пароль соответствует текущему! Придумайте другой',
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
                    text: "Длина пароля должна быть минимум 6 и не более 30 символов!",
                    status: 'error',
                    autoclose: true,
                    autotimeout: 2000                    
                })

                play();

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
            $.ajax({
                type: 'GET',
                url: '/pages/editpass.php?type=editpass',
                data: $('#changepass').serialize(),
                success: function(data) {
                    if(data == 'YES') {
                        new Notify ({
                            title: 'Успешно',
                            text: "Вы успешно сменили пароль!",
                            status: 'success',
                            autoclose: true,
                            autotimeout: 2000                 
                        })

                        setInterval(() => {
                            window.location = "/logout"
                        }, 500);

                        play()
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
                    }
                }
            });
        });
    });  
</script>
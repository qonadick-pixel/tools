<div class="modal modal-change-email">
    <div class="modal-content">
        <div class="mc-header" style="text-align: center">
            <div class="mch-close">
                <i class="fa-solid fa-xmark mchc-close" onclick="openModalChangeEmail()"></i>
            </div>
            <div class="mch-header">
                <a>Изменение почты</a>
            </div>
            <div class="mch-footer">
                <form class="form" id="changemail">
                    <div class="form__note">
                        <p>Проверьте папку спам, <a class="form__link">если не видите код</a></p>
                    </div>

                    <div class="form__group" style="">
                        <input class="form__input" placeholder="" type="name" id="newemail" name="newemail">
                        <label for="newemail" class="form__label">Введите новую почту</label>
                    </div>

                    <div class="form__group" style="">
                        <input class="form__input" placeholder="" type="name" id="codeone" name="codeone">
                        <label for="codeone" class="form__label">Код со старой почты</label>
                        <div class="form__button send_btnn" id="sendMailone" style="position: absolute; right: 20px; font-size 8px !important;">отправить</div>
                    </div>

                    <div class="form__group" style="">
                        <input class="form__input" placeholder="" type="name" id="codetwo" name="codetwo">
                        <label for="codetwo" class="form__label">Код с новой почты</label>
                        <div class="form__button send_btnnn" id="sendMailtwo" style="position: absolute; right: 20px; font-size 8px !important;">отправить</div>
                    </div>
                </form>

                

                <div class="form__footer">
                    <button class="btn__choose btn__modal" onclick='editemail()'>изменить</button>
                    <button class="btn__choose btn__modal btn_margin__left_form" onclick="openModalChangeEmail()">отмена</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function play() {
        var snd = new Audio("/assets/sound/notify.mp3");
        snd.play()
        snd.currentTime=0
    }

    function editemail() {
        var newemail = document.getElementById("newemail").value;
        var codeone = document.getElementById("codeone").value;
        var codetwo = document.getElementById("codetwo").value;
        if(codeone.length == 0 || codetwo.length == 0 || newemail.length == 0) {
            new Notify ({
                title: 'Ошибка',
                text: "Заполните поля, чтобы изменить почту!",
                status: 'error',
                autoclose: true,
                autotimeout: 2000                    
            })

            play()

            event.preventDefault();
            return false; 
        }
    }
    let sendBtnn = document.querySelector('.send_btnn')
    $(document).ready(function(){
        $('#sendMailone').click(function(){
            $.ajax({
                type: 'GET',
                url: '/pages/sendmail.php?type=emailone',
                success: function(data) {
                    if (data.search('#oldmailsent') != -1) {

                        sendBtnn.classList.add('active')

                        data = data.replace('#oldmailsent', '');
                        new Notify ({
                            title: 'Успешно',
                            text: data,
                            status: 'success',
                            autoclose: true,
                            autotimeout: 2000                    
                        })

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

        let sendBtnnn = document.querySelector('.send_btnnn')
        $('#sendMailtwo').click(function(){
            var newemail = document.getElementById("newemail").value;

            if(newemail.length == 0) {
                new Notify ({
                    title: 'Ошибка',
                    text: 'Вы не указали почту, на которую нужно выслать код',
                    status: 'error',
                    autoclose: true,
                    autotimeout: 2000                    
                })
                play();
                event.preventDefault();
                return false;    
            }
            $.ajax({
                type: 'GET',
                url: '/pages/sendmail.php?type=emailtwo',
                data: $('#changemail').serialize(),
                success: function(data) {
                    if (data.search('#newmailsent') != -1) {

                        sendBtnnn.classList.add('active')

                        data = data.replace('#newmailsent', '');
                        new Notify ({
                            title: 'Успешно',
                            text: data,
                            status: 'success',
                            autoclose: true,
                            autotimeout: 2000                    
                        })

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
    function changeFocus() {
        $('.send_btn').toggleClass('send_btn_active');
    }
</script>
<script>
$("#changemail").on('submit', function(e) {    
    e.preventDefault();

    $.ajax({
        type: 'GET',
        url: '/pages/changeemail.php',
        data: $('#changemail').serialize(),
        success: function(data) {
            if(data == 'YES') {
                new Notify ({
                    title: 'Успешно',
                    text: "Вы успешно сменили почту!",
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
</script>
<div class="modal modal-acces-reset-hwid">
    <div class="modal-content">
        <div class="mc-header" style="text-align: center">
            <div class="mch-close">
                <i class="fa-solid fa-xmark mchc-close" onclick="openModalAccesResetHWID()"></i>
            </div>
            <div class="mch-header" style="margin-bottom: 20px">
                <a>Запрос сброса HWID ключа</a>
            </div>
            <div class="mch-footer">
                <form class="form" id="resethwid">
                    <div class="form__note">
                        <p>Укажите причину смены <a class="form__link">HWID</a> ключа</p>
                    </div>

                    <div class="form__group">
                        <textarea name="reasonhwid" id="reasonhwid" cols="30" rows="5" placeholder="Причина"></textarea>
                    </div>
                </form>

                <div class="form__footer" style="margin-top: 10px">
                    <button class="btn__choose send_btn btn__modal" id="sendrequesthwid">Отправить</button>
                    <button class="btn__choose btn__modal btn_margin__left_form" onclick="openModalAccesResetHWID()">Отмена</button>
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
    $(document).ready(function(){
        $('#sendrequesthwid').click(function(){
            var reasonhwid = document.getElementById("reasonhwid").value;

            if(reasonhwid.length == 0) {
                new Notify ({
                    title: 'Ошибка',
                    text: "Вы не указали причину для сброса HWID'a!",
                    status: 'error',
                    autoclose: true,
                    autotimeout: 2000                    
                })
                play();
                event.preventDefault();
                return false;    
            } else if(reasonhwid.length > 50) {
                new Notify ({
                    title: 'Ошибка',
                    text: "Длина причины не должна превышать 50 символов!",
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
                url: '/pages/sendrequest.php?type=resethwid',
                data: $('#resethwid').serialize(),
                success: function(data) {
                    if(data == 'YES') {
                        openModalAccesResetHWID();
                        new Notify ({
                            title: 'Успешно',
                            text: "Запрос на сброс HWID был успешно отправлен! Ожидайте ответа..",
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

                        play();
                        event.preventDefault();
                        return false;    
                    }
                }
            });
        });
    });
</script>

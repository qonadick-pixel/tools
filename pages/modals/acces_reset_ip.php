<div class="modal modal-acces-reset-ip">
    <div class="modal-content">
        <div class="mc-header" style="text-align: center">
            <div class="mch-close">
                <i class="fa-solid fa-xmark mchc-close" onclick="openModalAccesResetIP()"></i>
            </div>
            <div class="mch-header" style="margin-bottom: 20px">
                <a>Запрос сброса IP адреса ключа</a>
            </div>
            <div class="mch-footer">
                <form class="form" id="resetip">
                    <div class="form__note">
                        <p>Укажите причину смены, <a class="form__link">IP адреса</a> ключа</p>
                    </div>

                    <div class="form__group">
                        <textarea name="reasonip" id="reasonip" cols="30" rows="5" placeholder="Причина"></textarea>
                    </div>

                    <div class="form__footer" style="margin-top: 10px">
                        <button class="btn__choose send_btn btn__modal" id="sendrequestip">отправить</button>
                        <button class="btn__choose btn__modal btn_margin__left_form" onclick="openModalAccesResetIP()">отмена</button>
                    </div>

                </form>
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
        $('#sendrequestip').click(function(){
            $.ajax({
                type: 'GET',
                url: '/pages/sendrequest.php?type=resetip',
                data: $('#resetip').serialize(),
                success: function(data) {
                    if(data == 'YES') {
                        new Notify ({
                            title: 'Успешно',
                            text: "Запрос на сброс IP-адреса был успешно отправлен! Ожидайте ответа..",
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
</script>

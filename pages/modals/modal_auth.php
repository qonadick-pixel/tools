            <div class="modal modal-auth">
                <div class="modal-content">
                    <div class="mc-header" style="text-align: center">
                        <div class="mch-close">
                            <i class="fa-solid fa-xmark mchc-close" onclick="openModalAuth()"></i>
                        </div>
                        <div class="mch-header">
                            <a>Авторизация в </a><a style="color: #6b73ff;">Grand Tools</a>
                        </div>
                        <div class="mch-footer">
                            <a style="font-size:20px">Используйте данный ключ для авторизации в скрипте.</a>
                            <a style="font-size:15px; color: red">Запрещено передавать сгенерированные ключи другим пользователям!</a>
                        </div>
                    </div>
                    <div class="mc-img">
                        <img src="/assets/img/img_auth.png" alt="" style="width: 100%; height: 60%">
                    </div>
                    <div class="mc-main">
                        <div class="mcm-input">
                            <input id="zxckey" name="zxckey" type="text" value='<?php echo $my_key ?>' readonly="">
                        </div>
                        <div class="mcm-buttons">
                            <button class="mcmm-btn" id="regenerate" type="regenerate" value="regenerate"><i class="fa-solid fa-arrows-rotate"></i>
                            <button class="mcmm-btn" onclick="copy()"><i class="fa-solid fa-copy"></i></button>
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
                function copy() {
                    if(document.getElementById("zxckey").value != 'Не сгенерирован') {
                        document.querySelector("#zxckey").select();
                        document.execCommand("copy");

                        new Notify ({
                            title: 'Успешно',
                            text: 'Ключ был скопирован в буфер обмена',
                            status: 'success',
                            autoclose: true,
                            autotimeout: 2000                    
                        })
                        play()
                    } else if(document.getElementById("zxckey").value == 'Не сгенерирован') {
                        new Notify ({
                            title: 'Ошибка',
                            text: 'Сгенерируйте ключ, чтобы скопировать его',
                            status: 'warning',
                            autoclose: true,
                            autotimeout: 2000                    
                        })
                        play()
                    }
                }
            </script>
            
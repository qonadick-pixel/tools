<div class="modal modal-request-reset-hwid">
    <div class="modal-content">
        <div class="mc-header" style="text-align: center">
            <div class="mch-close">
                <i class="fa-solid fa-xmark mchc-close" onclick="openModalRequestResetHWID()"></i>
            </div>
            <div class="mch-header">
                <a>Запросы на сброс </a><a style="color: #6b73ff;">HWID ключа</a>
            </div>
            <div class="mch-footer" style="width: 100%">
                <div class="users__requests">
                    <div class="user_request">
                        кто-то
                    </div>
                    <div class="discuss">
                        <i class="fa-solid fa-check" style="color: green; cursor: pointer"></i>
                        <i class="fa-solid fa-xmark" style="color: red; cursor: pointer"></i>
                    </div>
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
    function copy() {
        document.querySelector("#zxckey").select();
        document.execCommand("copy");

        new Notify ({
            title: 'Успешно',
            text: 'Ключ был успешно скопирован',
            status: 'success',
            autoclose: true,
            autotimeout: 2000                    
        })
        play()
    }
</script>

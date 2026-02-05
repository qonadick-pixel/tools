<style>
    .tg__link__btn {
        background-color: #6B73FF;
        font-size: 20px;
        padding: 5px 20px;
        border-radius: 5px;
        color: #fff;
        text-align: center;
        border: none;
        margin-top: 10px;
        transition: .25s;
        cursor: pointer;
        text-align: center;
        display: inline-block;
    }
    .tg__link__btn:hover {
        background-color: #fff;
        color: #6b73ff;
    }
</style>

<div class="modal modal-telegram_link popup-active">
    <div class="modal-content">
        <div class="mc-header" style="text-align: center">
            <div class="mch-close">
                <i class="fa-solid fa-xmark mchc-close" onclick="openModalTelegramLink()"></i>
            </div>
            <div class="mch-header" style="margin-bottom: 20px">
                <a>Подпишись на наш</a><a style="color: #6b73ff;"> Telegram канал!</a>
            </div>
            <div class="mch-footer" style="width: 100%; display: flex; justify-content: left; align-items: center">

                <img src="assets/img/qwesa.png" style="width: 465.5px; height: 195px; border-radius: 10px">

                <p style="text-align: left; font-size: 15px; margin-top: 10px">Будем рассказывать о главном -- обновления, исправления, обсуждения на новые системы и тд.!</p>
                <p style="text-align: left; font-size: 15px; width: 100%">Никакого спама. Говорим только важную и необходимую информацию.</p>
                
                <div style="text-align: center; justify-content: center; align-items: center">
                    <i class="fa-brands fa-telegram" style="font-size: 35px"></i>
                    <button onClick="javascript:window.open('https://t.me/grndtools', '_blank');" class="tg__link__btn" type="button">Подписаться</button>
                </div>
            </div>
        </div>
    </div>
</div>
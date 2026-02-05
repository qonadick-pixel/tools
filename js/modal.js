function play() {
    var snd = new Audio("/assets/sound/notify.mp3");
    snd.play()
    snd.currentTime=0
}

function openModalCreateKey() {
    $('.modal-create-key').toggleClass('popup-active');
}

function openModalAuth() {
    $('.modal-auth').toggleClass('popup-active');
}

function openModalFreezeAllUsers() {
    $('.modal-freeze-all-users').toggleClass('popup-active');
}

function openModalChangePassword() {
    let sendBtn = document.querySelector('.send_btn')
    sendBtn.classList.remove('active')
    $('.modal-change-password').toggleClass('popup-active');
    $('.form__input').val('')
}

function openModalChangeEmail() {
    let sendBtnn = document.querySelector('.send_btnn')
    let sendBtnnn = document.querySelector('.send_btnnn')
    sendBtnn.classList.remove('active')
    sendBtnnn.classList.remove('active')
    $('.modal-change-email').toggleClass('popup-active');
    $('.form__input').val('')
}

function openModalAccesResetHWID() {
    $('.modal-acces-reset-hwid').toggleClass('popup-active');
    var reasonText = document.getElementById("reasonhwid");
    reasonText.value = '';
}

function openModalAccesResetIP() {
    $('.modal-acces-reset-ip').toggleClass('popup-active');
}

function openModalRequestResetHWID() {
    $('.modal-request-reset-hwid').toggleClass('popup-active');
}

function openModalRequestResetIP() {
    $('.modal-request-reset-ip').toggleClass('popup-active');
}

function openModalTelegramLink() {
    $('.modal-telegram_link').toggleClass('popup-active');
}
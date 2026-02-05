var modal_auth = document.getElementById("myModalAuthorization");
var btn_auth = document.getElementById("myBtnAuthorization");

btn_auth.onclick = function () {
    modal_auth.style.display = "block";
    console.log('auth')
}
window.onclick = function (event) {
    if (event.target == modal_auth) {
        modal_auth.style.display = "none";
    }
}
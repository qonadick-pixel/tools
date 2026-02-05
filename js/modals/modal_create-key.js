var modal = document.getElementById("myModalCreateKey");
var btn = document.getElementById("myBtnCreateKey");

btn.onclick = function () {
    modal.style.display = "block";
    console.log('create-key')
}
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
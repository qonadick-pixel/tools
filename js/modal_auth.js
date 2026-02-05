var modal = document.getElementById('myModallAuthorization');
var btn = document.getElementById("myBtnAuthorization");

btn.onclick = function () {
    modal.style.display = "block";
    console.log('asdasd')
}
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
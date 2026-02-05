document.body.onload = function () {
    setTimeout(function() {
        var preloader = document.getElementById('preloader');
        var body = document.getElementById('app_body');
        if (!preloader.classList.contains('preloader__hide'))
        {
            preloader.classList.add('preloader__hide')
            body.classList.add('body__visible')
        }
    }, 500);
}
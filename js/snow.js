/* Используем jQuery процедуру - .ready(function) */
$(document).ready(function() {
    for (var i=0; i<10; i++) {
        /* 
           Создадим 10 снежинок
        */
        $(document.body).append("<img class='snow' src='/assets/img/snow.png' />");
    }
 
    $(".snow").each(function() {
        $(this).css({
            /* Зададим снежинкам случайную позицию на сайте */
            "top" : generateTop(this) + "px",
            "left" : generateLeft(this) + "px"
        });
    });
     
    /* 
    Создаем таймер, который будет вызывать функцию moveSnow каждые 10 миллисекунд
    т.е. 100 раз в секунду
    */
    setInterval(moveSnow, 10);
});
 
function moveSnow() {
    $(".snow").each(function() {
        /*Все снежинки будем двигать на 4 пикселя вниз, и по синусоиде влево и вправо*/
        var thisTop = parseInt($(this).css("top")) + 2 + Math.random() * 2;
        var thisLeft = parseInt($(this).css("left")) + 5 * Math.sin(thisTop / 100);
 
        /* Применяем высчитанную новую позицию снежинке */
        $(this).css({
            "top" : thisTop+"px",
            "left" : thisLeft+"px"
        });
 
        /* Проверяем на вылет за пределы документа по высоте */
        if (thisTop > $(document).height() - $(this).height() - 10) {
            $(this).css("top", -$(this).height() + "px");
        }
 
        /* Проверяем на вылет за пределы документа по ширине */
        if ((thisLeft > $(document).width() - $(this).width() - 10) || (thisLeft < 0)) {
            $(this).css("left", generateLeft(this) + "px");
        }
    });
}
 
function generateLeft(snow) {
    return Math.random() * ($(document).width() - $(snow).width());
}
 
function generateTop(snow) {
    return Math.random() * ($(document).height() - $(snow).height() );
}

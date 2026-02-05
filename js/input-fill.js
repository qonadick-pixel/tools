$('input').keyup(function(event) {
    var value = $(this).val();
    if (value) {
      $(this).addClass('input-fill');
    } else{
      $(this).removeClass('input-fill');
    }
});
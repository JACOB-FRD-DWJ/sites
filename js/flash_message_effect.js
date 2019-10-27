$(function () {
    var div = $('#alert');
    var close = $(".close");
    if (div.length > 0) {
        $(close).click(function () {
            $(div).slideUp();
        }),
        setTimeout(function () {
            $(div).slideUp();
        }, 2500);
    }
})
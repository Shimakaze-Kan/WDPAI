jQuery(function ($) {
    $('#burger').click(function () {
        $('#slide-nav').css('visibility', 'visible').slideDown(300).delay(500).children().slideDown(300);
        $('#shadow-menu').show();
    });

    $('#shadow-menu').click(function () {
        $('#slide-nav').children().slideUp(300).delay(300).parent().css('visibility', 'hidden');
        $('#shadow-menu').hide();
    });
});
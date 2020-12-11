jQuery(function ($) {
    $('.add-container #title-input').bind('input', function () {
        $('.title').text($('#title-input').val());
    });

    $('.add-container #upload-input').bind('input', function () {
        $("#img").attr("src",$('#upload-input').val());
    });


var currentMousePos = { x: -1, y: -1 };
$(document).mousemove(function (event) {
    currentMousePos.x = event.pageX + 10;
    currentMousePos.y = event.pageY;
});

$('#preview').mouseover(function (){
    $('#question-preview').css({ 'top': currentMousePos.y, 'left': currentMousePos.x }).fadeIn('fast');
});

    $('#preview').mouseout(function () {
        $('#question-preview').fadeOut('fast'); //.css({ 'display': 'none' });
    });

    $('#preview').mousemove(function () {
        $('#question-preview').css({ 'top': currentMousePos.y, 'left': currentMousePos.x });
    });

});
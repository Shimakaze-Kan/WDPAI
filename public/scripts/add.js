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

    $('#title-text').mouseover(function (){
        $('#DivToShow').text('Max title length: 50 characters');
        var pos = $('#title-text').offset();
        $('#DivToShow').css({ 'top': pos.top, 'left': pos.left }).fadeIn('fast');
    });

    $('#title-text').mouseout(function () {
        $('#DivToShow').fadeOut('fast'); //.css({ 'display': 'none' });
    });

    $('#upload-text').mouseover(function (){
        $('#DivToShow').text('Max URL length: 255 characters');
        var pos = $('#upload-text').offset();
        $('#DivToShow').css({ 'top': pos.top, 'left': pos.left }).fadeIn('fast');
    });

    $('#upload-text').mouseout(function () {
        $('#DivToShow').hide(); //.css({ 'display': 'none' });
    });

    $('#DivToShow').mouseover(function (){
       $(this).hide();
    });


    $('#submit-button').click(function (){
        if($('input[name="checkbox"]').prop('checked'))
        {
            const title_text = $('#title-input').val();
            var upload_text = $('#upload-input').val();

            if(title_text.length > 50)
            {
                $('#title-input').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                showMessage(false);
            }
            else if(upload_text.length > 255)
            {
                $('#upload-input').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                showMessage(false);
            }
            else {
                $.ajax({
                    url: "addTopic",
                    type: "POST",
                    data: {url: upload_text},
                    success: function (response) {

                        showMessage(response == "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        showMessage(false);
                    }
                });
            }
        }
        else
        {
            $('.checkbox').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
            showMessage(false);
        }
    });
});

function showMessage(result)
{
    if(result==true)
    {
        $('#messageboxq').html("Success");
        $('#messageboxq').css("background-color"," rgba(72, 205, 183, 0.9)");
    }
    else
    {
        $('#messageboxq').html("Failure");
        $('#messageboxq').css("background-color"," rgba(240, 52, 52, 0.9)");
    }
    $( "#messageboxq" ).slideDown( 300 ).delay( 5000 ).slideUp( 400 );
}
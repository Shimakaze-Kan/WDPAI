jQuery(function ($) {
    $('.add-container #title-input').bind('input', function () {
        $('.title').text($('#title-input').val());
    });

    $('.add-container #upload-input').bind('input', function () {
        $("#img").attr("src",$('#upload-input').val());
    });


let currentMousePos = { x: -1, y: -1 };
$(document).mousemove(function (event) {
    currentMousePos.x = event.pageX + 30;
    currentMousePos.y = event.pageY;
});

const TOPIC_PREVIEW_HEIGHT = 300;

$('#preview').mouseover(function (){
    let yPos = currentMousePos.y;

    if(yPos+TOPIC_PREVIEW_HEIGHT>window.innerHeight)
    {
        $('#preview-topic-container').css({ 'top': currentMousePos.y-TOPIC_PREVIEW_HEIGHT, 'left': currentMousePos.x }).fadeIn('fast');
    }
    else {
        $('#preview-topic-container').css({'top': currentMousePos.y, 'left': currentMousePos.x}).fadeIn('fast');
    }
});

    $('#preview').mouseleave(function () {
        $('#preview-topic-container').fadeOut('fast'); //.css({ 'display': 'none' });
    });

    $('#preview').mousemove(function () {
        let yPos = currentMousePos.y;

        if(yPos+TOPIC_PREVIEW_HEIGHT>window.innerHeight)
        {
            $('#preview-topic-container').css({ 'top': currentMousePos.y-TOPIC_PREVIEW_HEIGHT, 'left': currentMousePos.x });
        }
        else {
            $('#preview-topic-container').css({'top': currentMousePos.y, 'left': currentMousePos.x});
        }
    });

    $('#title-text').mouseover(function (){
        $('#DivToShow').text('Max title length: 50 characters');
        let pos = $('#title-text').offset();
        $('#DivToShow').css({ 'top': pos.top, 'left': pos.left }).fadeIn('fast');
    });

    $('#title-text').mouseleave(function () {
        $('#DivToShow').fadeOut('fast'); //.css({ 'display': 'none' });
    });

    $('#upload-text').mouseover(function (){
        $('#DivToShow').text('Max URL length: 16384 characters');
        let pos = $('#upload-text').offset();
        $('#DivToShow').css({ 'top': pos.top, 'left': pos.left }).fadeIn('fast');
    });

    $('#upload-text').mouseleave(function () {
        $('#DivToShow').hide(); //.css({ 'display': 'none' });
    });

    $('#DivToShow').mouseover(function (){
       $(this).hide();
    });


    $('#submit-button').click(function (){
        if($('input[name="checkbox"]').prop('checked') || $('#upload-input').val()=="")
        {
            let title_text = $('#title-input').val();
            let upload_text = $('#upload-input').val();

            if(title_text.length > 50 || title_text.length==0)
            {
                $('#title-input').shake();
                $('#title-text').shake();
                showMessage(false);
            }
            else if(upload_text.length > 16384)
            {
                $('#upload-input').shake();
                $('#upload-text').shake();
                showMessage(false);
            }
            else {
                $.ajax({
                    url: "addTopic",
                    type: "POST",
                    data: {title: title_text, url: upload_text},
                    dataType: "json",
                    success: function (response) {
                        if(response.state == 'failure')
                        {
                            showMessage(false);
                            $('.alert-messages').children().text(response.message);
                            $('.alert-messages').slideDown( 300 ).delay( 5000 ).slideUp( 400 );
                        }
                        else
                        {
                            if('url' in response) {
                                window.location = response.url;
                            }
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        showMessage(false);
                    }
                });
            }
        }
        else
        {
            $('.checkbox').shake();
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

jQuery.fn.shake = function(interval,distance,times){
    interval = typeof interval == "undefined" ? 100 : interval;
    distance = typeof distance == "undefined" ? 10 : distance;
    times = typeof times == "undefined" ? 3 : times;
    let jTarget = $(this);
    jTarget.css('position','relative');
    for(let iter=0;iter<(times+1);iter++){
        jTarget.animate({ left: ((iter%2==0 ? distance : distance*-1))}, interval);
    }
    return jTarget.animate({ left: 0},interval);
}
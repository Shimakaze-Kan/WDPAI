jQuery.fn.shake = function(interval,distance,times){
    interval = typeof interval == "undefined" ? 100 : interval;
    distance = typeof distance == "undefined" ? 10 : distance;
    times = typeof times == "undefined" ? 3 : times;
    var jTarget = $(this);
    jTarget.css('position','relative');
    for(var iter=0;iter<(times+1);iter++){
        jTarget.animate({ left: ((iter%2==0 ? distance : distance*-1))}, interval);
    }
    return jTarget.animate({ left: 0},interval);
}

function validateEmail(){
    if(!/\S+@\S+\.\S+/.test($("input[name='email']").val()))
    {
        $("input[name='email']").addClass('no-valid');
        return false;
    }
    else
    {
        $("input[name='email']").removeClass('no-valid');
        return true;
    }
}

function validatePasswords(){
    if($("input[name='repeatPassword']").val() != $("input[name='password']").val() || $("input[name='password']").val().length<4)
    {
        $("input[name='repeatPassword']").addClass('no-valid');
        $("input[name='password']").addClass('no-valid');
        return false;
    }
    else
    {
        $("input[name='repeatPassword']").removeClass('no-valid');
        $("input[name='password']").removeClass('no-valid');
        return true;
    }
}


$("input[name='email']").on('input', function() {
    validateEmail();
});
$("input[name='password']").on('input', function() {
    validatePasswords();
});
$("input[name='repeatPassword']").on('input', function() {
    validatePasswords();
});

$('.register-button').click(function (){
    if(!validateEmail())
    {
        $("input[name='email']").parent().shake();
        return;
    }
    if(!validatePasswords())
    {
        $("input[name='password']").parent().shake();
        $("input[name='repeatPassword']").parent().shake();
        return;
    }
    if(!$('input[name="checkbox"]').is(':checked'))
    {
        $('.checkbox').shake();
        return;
    }

    $('form.register').submit();
});

if($('.alert-messages').length)
{
    $('.alert-messages').slideDown( 300 ).delay( 5000 ).slideUp( 400 );
}
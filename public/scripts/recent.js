jQuery(function ($) {
    $("div[id^='topic-']").each(function (index) {
        $(this).on('click', function () {
            const tmp = $(this).attr('id');
            const id = tmp.substring(6,tmp.length);

            window.location = "tea?id="+id;
        });
    });

    $("span[id^='user-id-']").each(function (index) {
        $(this).on('click', function () {
            const tmp = $(this).attr('id');
            const id = tmp.substring(8,tmp.length);
            window.location = "profile?id="+id;
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

    function decrementTimer(timer){
        const updatedTimerValue = timer.text().substr(0,1)-1;
        if(updatedTimerValue==-1)
        {
            return;
        }
        timer.text(updatedTimerValue+'s');
        setTimeout(decrementTimer,1000,timer);
    }

    let timersCollection = [];
    $("div[id^='trash-bin-']").each(function (index) {
        $(this).on('click', function () {
        let parent = $(this).closest(".minimal-topic-box");
        const tmp = $(this).attr('id');
        const id = tmp.substring(10,tmp.length);
        const timer = parent.find('span[id^="timer-"]');
        timer.text('6s');

        parent.find('span[id^="stop-"]').show();
        parent.find('span[id^="timer-"]').show();
        parent.find('div[id^="trash-bin-"]').hide();
        decrementTimer(timer);
        const tmpTimer = setTimeout(deleteTopic, 5000,{'parent': parent, 'id': id});
        timersCollection[id]=tmpTimer;
        });
    });

    function deleteTopic(topicToDelete){
        const currentTopic = topicToDelete;
        const id = currentTopic.id;
        const parent = currentTopic.parent;

        $.ajax({
            url: "deleteTopic",
            type: "POST",
            data: {id: id},
            success: function (response) {
                showMessage(response == "success");
                parent.fadeOut("slow");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showMessage(false);
            }
        });
    }

    $('span[id^="stop-"]').click(function (){
        const tmp = $(this).attr('id');
        const idOfTimerToStop = tmp.substring(5,tmp.length);
        clearTimeout(timersCollection[idOfTimerToStop]);
        $(this).hide();
        $(this).parent().parent().find('span[id^="timer-"]').hide();
        $(this).parent().parent().find('div[id^="trash-bin-"]').show()
    });
});
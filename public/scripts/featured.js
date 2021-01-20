jQuery(function ($) {
    $('div > div > img').each(function (index) {
        $(this).on('click', function () {
            const tmp = $(this).parent().parent().attr('id');
            const id = tmp.substring(9, tmp.length);
            window.location = "tea?id=" + id;
        });
    });

    function showMessage(result) {
        if (result == true) {
            $('#messageboxq').html("Success");
            $('#messageboxq').css("background-color", " rgba(72, 205, 183, 0.9)");
        } else {
            $('#messageboxq').html("Failure");
            $('#messageboxq').css("background-color", " rgba(240, 52, 52, 0.9)");
        }
        $("#messageboxq").slideDown(300).delay(5000).slideUp(400);
    }

    function rateTopic(topicToRate, feedback, obj) {
        $.ajax({
            url: "rateTopic",
            type: "POST",
            data: {id: topicToRate, feedback: feedback},
            dataType: "json",
            success: function (response) {
                if (response.state == 'success') {
                    showMessage(true);
                    obj.text(' ' + (parseInt(obj.text()) + 1));
                } else {
                    showMessage(false);
                    $('.alert-messages').children().text(response.message);
                    $('.alert-messages').slideDown(300).delay(5000).slideUp(400);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showMessage(false);

            }
        });
    }

    $("i.fas.fa-heart").each(function (index) {
        $(this).on('click', function () {
            const id = $(this).parent().parent().parent().attr('id').substring(9);
            rateTopic(id, 'like', $(this));
        });
    });

    $("i.fas.fa-heart-broken").each(function (index) {
        $(this).on('click', function () {
            const id = $(this).parent().parent().parent().attr('id').substring(9);
            rateTopic(id, 'dislike', $(this));
        });
    });

});
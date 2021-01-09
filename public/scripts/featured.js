jQuery(function ($) {
    $("div[id^='question-']").each(function (index) {
        $(this).on('click', function () {
            const tmp = $(this).attr('id');
            const id = tmp.substring(9,tmp.length);
            window.location = "tea?id="+id;
        });
    });
});
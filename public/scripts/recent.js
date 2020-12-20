jQuery(function ($) {
    $("div[id^='topic-']").each(function (index) {
        $(this).on('click', function () {
            const tmp = $(this).attr('id');
            const id = tmp.substring(6,tmp.length);
            const title = $(this).find('.title-mininal-box').text();
            window.location = "tea?id="+id+"&title="+title.split(" ").join("_");
        });
    });
});
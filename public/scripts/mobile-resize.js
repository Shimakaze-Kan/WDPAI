let isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;

if(isMobile) {
    $(window).resize(onresize);

    var wasLandscapeViewBefore = false;

    function onresize() {
        let newViewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
        let newViewportWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        let landscapeView = (newViewportHeight < newViewportWidth) == true;


            if (landscapeView) {
                $('nav').show();
                $('nav').css({'visibility': 'visible',"width": newViewportWidth - newViewportWidth * 0.8, "height": newViewportHeight});
                $('nav').children().each(function ()
                {
                    $(this).show();
                })
                $('#shadow-menu').hide();
                wasLandscapeViewBefore = true;
            } else {
                $('#shadow-menu').css({"width": newViewportWidth / 2, "height": newViewportHeight});
                if ($('nav').is(":visible") || $('#shadow-menu').is(":visible")) {
                    $('nav').hide();
                    $('#shadow-menu').hide();
                } else {
                    $('nav').css({"width": newViewportWidth / 2, "height": newViewportHeight});
                }
                wasLandscapeViewBefore = false;
            }

    }
}
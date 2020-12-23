let isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;

if(isMobile) {
    $(window).resize(onresize);

    let wasLandscapeViewBefore = false;

    function onresize() {
        let newViewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
        let newViewportWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        let landscapeView = (newViewportHeight < newViewportWidth) == true;

        if(/iPad/.test(navigator.userAgent))
        {
            if(!landscapeView) {
                $('nav').css({"width": newViewportWidth - newViewportWidth * 0.7, "height": newViewportHeight});
            }
            else
            {
                $('nav').css({"width": newViewportWidth - newViewportWidth * 0.8, "height": newViewportHeight});
            }
        }
        else {
            if (landscapeView) {
                $('nav').css({"width": newViewportWidth - newViewportWidth * 0.8, "height": newViewportHeight});
                $('#shadow-menu').hide();
                $('#slide-nav').slideDown(300).delay(500).children().slideDown(300);
                wasLandscapeViewBefore = true;
            } else {
                $('#shadow-menu').css({"width": newViewportWidth / 2, "height": newViewportHeight});
                if (wasLandscapeViewBefore) {
                    $('nav').hide();
                } else {
                    $('nav').css({"width": newViewportWidth / 2, "height": newViewportHeight});
                }
                wasLandscapeViewBefore = false;
            }
        }
    }
}
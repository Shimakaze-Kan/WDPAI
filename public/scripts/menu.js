var state = true;
function openNav() {
    if (state) {
        $('#slide-nav').children().slideUp(300).delay(300).parent().hide(300);
        //$('#slide-nav').hide();
        document.querySelectorAll("main")[0].style.filter = "blur(3px) grayscale(1)";
        state = false;
    }
    else {
        state = true;
        //document.getElementById("slide-nav").style.visibility = "visible";
        $('#slide-nav').show();
        $('#slide-nav').children().slideDown(500);


    }
}
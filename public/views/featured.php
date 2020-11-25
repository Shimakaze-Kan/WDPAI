<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions.css">
    <link rel="stylesheet" type="text/css" href="public/css/style-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions-mobile.css">


    <!--<script src="https://kit.fontawesome.com/8fb5fa0f9e.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <title>LOGIN PAGE</title>

</head>   
<script>
    var state = false;
function openNav() {
    if(state)
    {
        document.getElementById("slide-nav").style.visibility = "collapse";
        document.querySelectorAll("main")[0].style.filter = "none";
        state = false;
    }
    else{
        state = true;
        document.getElementById("slide-nav").style.visibility = "visible";
        document.querySelectorAll("main")[0].style.filter = "blur(3px) grayscale(1)";
    }
}
</script>
<body>
    <div class="base-container">
      <nav id="slide-nav">
          <div id="small-logo" class="small-logo">
                CONNTLY
            </div>
        <ul>
            <li>                
                <a href="#" class="button">
                    <i class="fas fa-star"></i>
                    FEATURED</a>
            </li>
            <li>                
                <a href="#" class="button">
                    <i class="far fa-clock"></i>
                    RECENT</a>
            </li>
            <li>                
                <a href="#" class="button">
                    <i class="fas fa-user"></i>
                    ACCOUNT</a>
            </li>
            <li>                
                <a href="#" class="button">
                    <i class="fas fa-plus"></i>
                    ADD</a>
            </li>
            <li>                
                <a href="#" class="button">
                    <i class="fas fa-door-open"></i>
                    LOGOUT</a>
            </li>
        </ul>
      </nav>
      <main>
          <header>
            <div class="title-bar">
            <i class="fas fa-bars" id="burger" onclick="openNav()"></i>
                FEATURED
            </div>
          </header>
          <section class="questions">
            <div id="question-1">
                
                <div>
                    <div class="title">‘Tea’ in European languages</div>
                    <img src="public/img/uploads/xhlu3k3h.bmp">
                    
                    <div class="social-section">
                        <i class="fas fa-heart"> 600</i>
                        <i class="fas fa-share-square"> 101</i>
                    </div>
                </div>
            </div>
            <div id="question-2">
                <div>
                    <div class="title">‘Coma’ in European languages</div>
                    <img src="public/img/uploads/xhlu3k3h.bmp">
                    
                    <div class="social-section">
                        <i class="fas fa-heart"> 600</i>
                        <i class="fas fa-share-square"> 101</i>
                    </div>
                </div>
            </div>
            <div id="question-3">
                <div>
                    <div class="title">‘Election’ in European languages</div>
                    <img src="public/img/uploads/xhlu3k3h.bmp">
                    
                    <div class="social-section">
                        <i class="fas fa-heart"> 600</i>
                        <i class="fas fa-share-square"> 101</i>
                    </div>
                </div>
            </div>
            <div id="question-4">
                <div>
                    <div class="title">‘Easter’ in European languages</div>
                    <img src="public/img/uploads/xhlu3k3h.bmp">
                    
                    <div class="social-section">
                        <i class="fas fa-heart"> 600</i>
                        <i class="fas fa-share-square"> 101</i>
                    </div>
                </div>
            </div>
          
        </section>
      </main>
    </div>
</body>
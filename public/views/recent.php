<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/recent.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"
            charset="utf-8"></script>

    <!--<script src="https://kit.fontawesome.com/8fb5fa0f9e.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <script type="text/javascript" src="public/scripts/menu.js"></script>

    <title>CONNTLY🔌 - RECENT</title>

</head>
<body>
<div class="base-container">
    <?php include("nav.php"); ?>
    <main>
        <header>
            <div class="title-bar">
                <i class="fas fa-bars" id="burger" onclick="openNav()"></i>
                RECENT
            </div>
        </header>
        <section class="topic">
            <div class="minimal-topic-box">
                <div class="img-mininal-box"> <img src="https://s2.best-wallpaper.net/wallpaper/iphone/1911/Seagull-scream-beak-white-feathers_iphone_1242x2688.jpg" alt="Topic image" class="responsive-img"> </div>
                <div class="title-mininal-box">title</div>
                <div class="details-mininal-box">
                    <span class="author">created by: dupa</span>
                    <div class="minimal-social-box">
                    <i class="fas fa-heart"> 600</i>
                    <i class="fas fa-share-square"> 101</i>
                    </div>
                </div>
            </div>

            <div class="minimal-topic-box">
                <div class="img-mininal-box"><img src="https://interactive-examples.mdn.mozilla.net/media/cc0-images/grapefruit-slice-332-332.jpg" alt="Topic image" class="responsive-img"></div>
                <div class="title-mininal-box">title</div>
                <div class="details-mininal-box">like</div>
            </div>
        </section>
    </main>
</div>
</body>
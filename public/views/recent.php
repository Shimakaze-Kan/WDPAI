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
    <script type="text/javascript" src="public/scripts/recent.js"></script>

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
            <?php
            foreach ($topics as $value)
            {
                echo '<div title="created at: '.$value['date'].'" id="topic-'.$value['topicId'].'" class="minimal-topic-box">
                <div class="img-mininal-box"> <img src="'.$value['img_url'].'" alt="No topic image" class="responsive-img"> </div>
                <div class="title-mininal-box">'.$value['title'].'</div>
                <div class="details-mininal-box">
                    <span class="author">created by: '.$value['author'].'</span>
                    <div class="minimal-social-box">
                    <i class="fas fa-heart"> '.$value['like'].'</i>
                    <i class="fas fa-share-square"> '.$value['dislike'].'</i>
                    </div>
                </div>
            </div>';
            }


            ?>
        </section>
    </main>
</div>
</body>
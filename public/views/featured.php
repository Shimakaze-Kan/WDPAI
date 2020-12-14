<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions.css">
    <link rel="stylesheet" type="text/css" href="public/css/style-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions-mobile.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"
            charset="utf-8"></script>

    <!--<script src="https://kit.fontawesome.com/8fb5fa0f9e.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <script type="text/javascript" src="public/scripts/menu.js"></script>
    <script type="text/javascript" src="public/scripts/featured.js"></script>
    <title>LOGIN PAGE</title>

</head>
<body>
    <div class="base-container">
        <?php include("nav.php"); ?>
      <main>
          <header>
            <div class="title-bar">
            <i class="fas fa-bars" id="burger" onclick="openNav()"></i>
                FEATURED
            </div>
          </header>
          <section class="questions">

                    <?php
                    $topicRepository = new TopicRepository();
                    $featured = $topicRepository->getFeaturedTopicsIds();


                    for ($i=0; $i<count($featured); $i++) {
                        $topic = $topicRepository->getTopic($featured[$i]);

                        echo '<div id="question-'.$featured[$i].'">'.
                            '<div>'.
                            '<div class="title">' . $topic->getTitle() . '</div>' .
                            '<img src="' . $topic->getImgUrl() . '">' .

                            '<div class="social-section">' .
                            '<i class="fas fa-heart">'.$topic->getLike().'</i>' .
                            '<i class="fas fa-share-square">'.$topic->getDislike().'</i>' .
                            '</div> </div></div>';
                    }
                    ?>
                    <!--
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
            -->
        </section>
      </main>
    </div>
</body>
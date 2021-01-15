<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions.css">
    <link rel="stylesheet" type="text/css" href="public/css/style-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions-mobile.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"
            charset="utf-8"></script>

    <!--<script src="https://kit.fontawesome.com/8fb5fa0f9e.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script type="text/javascript" src="public/scripts/menu.js"></script>
    <script type="text/javascript" src="public/scripts/featured.js"></script>
    <script type="text/javascript" src="public/scripts/mobile-resize.js"></script>
    <script type="text/javascript" src="public/scripts/update-last-active.js"></script>
    <title>LOGIN PAGE</title>

</head>
<body>
    <div class="base-container">
        <?php include("nav.php"); ?>
      <main>
          <header>
            <div class="title-bar">
            <i class="fas fa-bars" id="burger"></i>
                FEATURED
            </div>
          </header>
          <div id="shadow-menu">Close</div>
          <section class="questions">

                    <?php
                    foreach ($topics as $topic) {

                        echo '<div id="question-'. $topic->getId() .'">'.
                            '<div>'.
                            '<div class="title">' . $topic->getTitle() . '</div>' .
                            '<img src="' . $topic->getImgUrl() . '">' .
                            '<div class="social-section">' .
                            '<i class="fas fa-heart">'.$topic->getLike().'</i>' .
                            '<i class="fas fa-share-square">'.$topic->getDislike().'</i>' .
                            '</div> </div></div>';
                    }
                    ?>
        </section>
      </main>
    </div>
</body>
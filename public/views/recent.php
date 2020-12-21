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
        <div id="messageboxq"></div>
        <section class="topic">
            <?php

            $isMode = false;
            if($_SESSION['user_role']=='mode') {
                $isMode=true;
            }

            foreach ($topics as $value)
            {
                echo '<div title="created at: '.$value['date'].'" class="minimal-topic-box">
                <div class="action-click-box" id="topic-'.$value['topicId'].'">
                <div class="img-mininal-box"> <img src="'.$value['img_url'].'" alt="No topic image" class="responsive-img"> </div>
                <div class="title-mininal-box">'.$value['title'].'</div>
                </div>
                <div class="details-mininal-box">
                    <span class="';
                    if($value['user_role']=='mode')
                    {
                        echo "rainbow_text_animated";
                    }
                    else
                    {
                        echo "author";
                    }
                    echo '">created by: '.$value['author'].'</span>
                    <div class="minimal-social-box">
                    <i class="fas fa-heart"> '.$value['like'].'</i>
                    <i class="fas fa-share-square"> '.$value['dislike'].'</i>
                    </div>
                </div>';

                if($isMode)
                {
                    echo '<div id="delete-'.$value['topicId'].'" style="color: red;background-color: rgba(243, 241, 239, 0.2);margin-top: inherit;width: 5%;display: flex;flex-direction: column;"><span class="timer-span" id="timer-'.$value['topicId'].'"></span><span class="stop-timer-button" id="stop-'.$value['topicId'].'">stop</span> <div id="trash-bin-'.$value['topicId'].'"><i class="fas fa-trash-alt" ></i ></div></div >';
                }

                echo '</div>';
            }

            ?>
        </section>
    </main>
</div>
</body>
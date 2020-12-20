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
                    echo '<div id="delete-'.$value['topicId'].'" style="color: red;background-color: #F8F8F8;margin-top: inherit;"><i class="fas fa-trash-alt" ></i ></div >';
                }

                echo '</div>';
            }

            if($isMode)
            {
                echo '<script>
jQuery(function ($) {
    function showMessage(result)
    {
    if(result==true)
    {
        $(\'#messageboxq\').html("Success");
        $(\'#messageboxq\').css("background-color"," rgba(72, 205, 183, 0.9)");
    }
    else
    {
        $(\'#messageboxq\').html("Failure");
        $(\'#messageboxq\').css("background-color"," rgba(240, 52, 52, 0.9)");
    }
    $( "#messageboxq" ).slideDown( 300 ).delay( 5000 ).slideUp( 400 );
}
    
    
    $("div[id^=\'delete-\']").each(function (index) {
        $(this).on(\'click\', function () {
            var parent = $(this).closest(".minimal-topic-box");;
            const tmp = $(this).attr(\'id\');
            const id = tmp.substring(7,tmp.length);
            $.ajax({
                    url: "deleteTopic",
                    type: "POST",
                    data: {id: id},
                    success: function (response) {
                        showMessage(response == "success");
                        parent.fadeOut("slow");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        showMessage(false);
                    }
                });
        });
    });
});
                
                    
</script>';
            }


            ?>
        </section>
    </main>
</div>
</body>
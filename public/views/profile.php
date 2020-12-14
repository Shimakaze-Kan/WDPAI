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
    <title>LOGIN PAGE</title>

</head>
<style>
    .bigfont {
        font: normal normal bold 2.5em Arial;
        letter-spacing: 0px;
        color: #000000B8;
        padding-top: 0.5em;
    }
</style>
<body>
<div class="base-container">
    <?php include("nav.php"); ?>
    <main>
        <header>
            <div class="title-bar">
                <i class="fas fa-bars" id="burger" onclick="openNav()"></i>
                ACCOUNT
            </div>
        </header>

        <span class="bigfont">Email: <?php echo $email ?></span>
        <span class="bigfont">User's ID: <?php echo $id ?></span>
        <img src="<?php echo $avatar_url?>" alt="<?php echo $email."'s avatar"?>" width="400" height="400">
    </main>
</div>
</body>
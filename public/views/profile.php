<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions.css">
    <link rel="stylesheet" type="text/css" href="public/css/style-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile.css">
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
        padding-left: 0.5em;
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

        <div id="profile-container">
            <div id="profile-content">
                <div id="avatar-container">
                    <img src="<?php echo $avatar_url?>" alt="<?php echo $email."'s avatar"?>" class="avatar">
                </div>
            <div id="info-container">
        <span class="bigfont">Email: <?php echo $email ?></span>
        <span class="bigfont">User's ID: <?php echo $id ?></span>
            </div>
            </div>


        <div id="data-table">
            <span class="bigfont">History:</span>
            <table id="myTable">
                <tbody>
                <tr>
                    <td>Topic</td>
                    <td>Date</td>
                    <td>Link</td>
                </tr>
                <?php
                foreach ($topics as $key => $value)
                {
                    echo '<tr><td>' . $value['title'] .'</td><td>'.$value['date'].'</td><td>'."<a href=".substr($_SERVER['SERVER_NAME'],0,-1).'tea?id='.$value['topicId']."&title=".str_replace(" ","_", $value['title'])." class='purple-button'>Go to topic</a>" .'</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
        </div>
    </main>
</div>
</body>
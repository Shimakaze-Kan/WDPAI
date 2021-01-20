<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions.css">
    <link rel="stylesheet" type="text/css" href="public/css/style-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile-mobile.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"
            charset="utf-8"></script>

    <!--<script src="https://kit.fontawesome.com/8fb5fa0f9e.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script type="text/javascript" defer src="public/scripts/menu.js"></script>
    <script type="text/javascript" defer src="public/scripts/mobile-resize.js"></script>
    <script type="text/javascript" defer src="public/scripts/profile.js"></script>
    <script type="text/javascript" defer src="public/scripts/update-last-active.js"></script>
    <title>LOGIN PAGE</title>

</head>

<body>
<div class="base-container">
    <?php include("nav.php"); ?>
    <div class="alert-messages"><span>'.$alertMessage.'</span></div>
    <main>
        <header>
            <div class="title-bar">
                <i class="fas fa-bars" id="burger"></i>
                ACCOUNT
                <?php
                if ($isOwnUserProfile) {
                    echo '<i title = "Edit profile" class="fas fa-cog" ></i >';
                }
                ?>
            </div>
        </header>
        <div class="edit-profile">
            <span class="bigfont">Avatar url</span>
            <input placeholder="Paste url to image">
            <span class="bigfont">About</span>
            <textarea rows="3" maxlength="500" placeholder="Write something"></textarea>
            <div>
                <button class="purple-button" id="send-updated-profile-details">UPDATE</button>
                <button class="purple-button" id="close-edit-profile">CLOSE</button>
            </div>
        </div>
        <div id="messageboxq">
        </div>
        <div id="shadow-menu">Close</div>
        <div id="profile-container">
            <div id="profile-content">
                <div id="avatar-container">
                    <img src="<?php echo $avatar_url ?>" alt="<?php echo $email . "'s avatar" ?>" class="avatar">
                </div>
                <div id="info-container">
        <span class="bigfont">Email: <?php echo $email;
            if ($ban != false) {
                echo '<span id="user-state" title="User banned until: ' . $ban . '" style="color:black"> ⬤</span>';
            } else if ($active) {
                echo '<span id="user-state" title="active" style="color:#2EFFAA"> ⬤</span>';
            } else {
                echo '<span id="user-state" title="inactive" style="color:red"> ⬤</span>';
            }

            ?></span>
                    <span id="user-id" class="bigfont">User's ID: <?php echo $id ?></span>
                    <span class="bigfont" <?php if ($role == 'mode') {
                        echo 'id="rainbow_text_animated">Role: Moderator';
                    } else {
                        echo ">Role: User";
                    }
                    ?></span>

                </div>
                <?php if ($isMode) {
                    echo '<div id="ban-user-container">
                <div class="lengend-action-buttons lengend-action-buttons-first">
                    <label for="d3_graph_chart0001day">
                        <input type="radio" name="date_range" id="d3_graph_chart0001day" value="1day" checked="checked">
                        <span>1 day</span>
                    </label>
                </div>
                <div class="lengend-action-buttons lengend-action-buttons-first">
                    <label for="d3_graph_chart0007day">
                        <input type="radio" name="date_range" id="d3_graph_chart0007day" value="7days">
                        <span>7 days</span>
                    </label>
                </div>
                <div class="lengend-action-buttons lengend-action-buttons-first">
                    <label for="d3_graph_chart0010years">
                        <input type="radio" name="date_range" id="d3_graph_chart0010years" value="10years">
                        <span>10 years</span>
                    </label>
                </div>
                <button id="ban-button" class="purple-button">BAN</button>
                <button id="unban-button" class="purple-button">UNBAN</button>
            </div>';
                } ?>
            </div>

            <?php
            if ($about != "") {
                echo '<div id="about">' .
                    '<span class="bigfont">About:</span>' .
                    '<span id="about-desc">' . $about . '<span/>' .
                    '</div>';
            }
            ?>

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
                    foreach ($topics as $key => $value) {
                        echo '<tr><td>' . $value['title'] . '</td><td>' . $value['date'] . '</td><td>' . "<a href=" . substr($_SERVER['SERVER_NAME'], 0, -1) . 'tea?id=' . $value['topicId'] . " class='purple-button'>Go to topic</a>" . '</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</body>
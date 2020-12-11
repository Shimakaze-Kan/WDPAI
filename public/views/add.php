<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions.css">
    <link rel="stylesheet" type="text/css" href="public/css/add.css">
    <link rel="stylesheet" type="text/css" href="public/css/style-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions-mobile.css">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"
            charset="utf-8"></script>

    <script type="text/javascript" src="public/scripts/menu.js"></script>
    <script type="text/javascript" src="public/scripts/add.js"></script>
    <!--<script src="https://kit.fontawesome.com/8fb5fa0f9e.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <title>LOGIN PAGE</title>

</head>
<body>
<div class="base-container">
    <?php include("nav.php"); ?>
    <main>
        <header>
            <div class="title-bar">
                <i class="fas fa-bars" id="burger" onclick="openNav()"></i>
                ADD NEW TOPIC
            </div>
        </header>
        <div class="add-container">
        <span class="bigfont">Title</span>
        <input id="title-input" type="text" maxlength="50" placeholder="Be precise, a good example is ['word' in European languages]">
        <span class="bigfont">Upload Image</span>
            <div>
        <input id="upload-input" type="text" placeholder="Upload image or paste URL">
            <button class="purple-button">BROWSE</button>
            </div>

            <span id="preview">Preview (mouse over)</span>

            <section id="question-preview" class="questions">
            <div id="question-1">

                <div>
                    <div class="title">‘Tea’ in European languages</div>
                    <img id="img" src="public/img/uploads/xhlu3k3h.bmp">

                    <div class="social-section">
                        <i class="fas fa-heart"> 600</i>
                        <i class="fas fa-share-square"> 101</i>
                    </div>
                </div>
            </div>
            </section>
        </div>

    </main>
</div>
</body>
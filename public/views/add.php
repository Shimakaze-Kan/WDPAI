<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions.css">
    <link rel="stylesheet" type="text/css" href="public/css/add.css">
    <link rel="stylesheet" type="text/css" href="public/css/style-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions-mobile.css">
    <link rel="stylesheet" type="text/css" href="public/css/add-mobile.css">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"
            charset="utf-8"></script>

    <script type="text/javascript" src="public/scripts/menu.js"></script>
    <script type="text/javascript" src="public/scripts/add.js"></script>
    <script type="text/javascript" src="public/scripts/mobile-resize.js"></script>
    <script type="text/javascript" src="public/scripts/update-last-active.js"></script>
    <!--<script src="https://kit.fontawesome.com/8fb5fa0f9e.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <title>LOGIN PAGE</title>

</head>
<style>
    .checkbox {
        margin: initial;
    }
    }
</style>
<body>
<div class="base-container">
    <?php include("nav.php"); ?>
    <div id="messageboxq"></div>
        <div id="DivToShow"></div>

    <main>
        <header>
            <div class="title-bar">
                <i class="fas fa-bars" id="burger"></i>
                ADD NEW TOPIC
            </div>
        </header>
        <div id="shadow-menu">Close</div>
        <div>
        <div class="add-container">

            <span class="bigfont" id="title-text">Title</span>
            <input id="title-input" maxlength="50" type="text" placeholder="Be precise, a good example is ['word' in European languages]">
        <span class="bigfont" id="upload-text">Upload Image</span>
            <div>
        <input id="upload-input" type="text" placeholder="Paste URL">
            <!--<button class="purple-button">BROWSE</button>-->
            </div>

            <div class="preview-container">
            <span id="preview">Preview (mouse over)</span>
            </div>

            <label class="checkbox">
                <input name="checkbox" type="checkbox"/>
                <span>I confirm that I have copyrights to the submitted image</span>
            </label>

            <div class="submit-button-container">
            <button id="submit-button">SUBMIT</button>

            </div>

            <div id="preview-topic-container">
            <div id="preview-topic-box">
                <div>
                    <div class="title">Topic Title</div>
                    <img id="img" src="public/img/uploads/No-image.svg">

                    <div class="social-section">
                        <i class="fas fa-heart"> 600</i>
                        <i class="fas fa-share-square"> 101</i>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </main>
</div>
</body>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style-mobile.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"
            charset="utf-8"></script>
    <title>LOGIN PAGE</title>

</head>
<body>
    <div class="container">
        <div class="logo">
            CONNTLY
        </div>
        <div class="login-container">
            <form class="login" action="login" method="POST">
                <div class="message">
                    <?php
                        if(isset($messages))
                        {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <div class="login-caption-container">
                    EMAIL
                    <input name="email" type="text" placeholder="email@email.com">
                </div>
                <div class="login-caption-container">
                    PASSWORD
                    <input name="password" type="password" placeholder="password">
                </div>
                <div class="login-buttons-container">
                    <button id="login-button" type="submit">LOGIN</button>
                    <button type="button" onclick="location.href='registration'">SIGN UP</button>
                </div>
            </form>    
        </div>
    </div>
</body>
<script>
    if(<?php echo $cookie ?>)
    {
        $('#login-button').click();
    }
</script>
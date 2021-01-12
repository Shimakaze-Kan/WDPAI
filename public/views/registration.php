<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style-mobile.css">

    <title>REGISTRATION PAGE</title>

</head>
<body>
    <div class="container">
        <div class="registration-container" id="registration-container">
            <form class="register" action="registration" method="POST">
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
                <h2 class="register-text">REGISTRATION</h2>
              
                        <div class="login-caption-container">
                            EMAIL
                            <input name="email" type="text" placeholder="email@email.com">
                        </div>
                  
                        <!--<div class="login-caption-container">
                            USERNAME
                            <input name="username" type="text" placeholder="marik1234">
                        </div>-->
                  
                        <div class="login-caption-container">
                            PASSWORD
                            <input name="password" type="password" placeholder="password">
                        </div>
                 
                        <div class="login-caption-container">
                            REPEAT PASSWORD
                            <input type="password" placeholder="password">
                        </div>


                   <label class="checkbox">
                            <input name="checkbox" type="checkbox" checked/>
                            <span>I accept the terms and conditions</span>
                        </label>
                  
                    <div class="login-buttons-container">
                        <button class="register-button">SIGN UP</button>
                    </div>
            </form>
        </div>
    </div>
</body>
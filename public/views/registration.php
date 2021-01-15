<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/style-mobile.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"
            charset="utf-8"></script>
    <script type="text/javascript" src="public/scripts/registration.js" defer></script>

    <title>REGISTRATION PAGE</title>

</head>
<body>
    <div class="container">

        <?php
        if(isset($messages))
        {
            $alertMessage = "";
            foreach ($messages as $message) {
                $alertMessage = $alertMessage.$message;
            }

            echo '<div class="alert-messages"><span>'.$alertMessage.'</span></div>';
        }
        ?>

        <div class="registration-container" id="registration-container">
            <form class="register" action="registration" method="POST">
                <h2 class="register-text">REGISTRATION</h2>
              
                        <div class="login-caption-container">
                            EMAIL
                            <input name="email" type="text" placeholder="email@email.com">
                        </div>

                        <div class="login-caption-container">
                            PASSWORD
                            <input name="password" type="password" placeholder="password">
                        </div>
                 
                        <div class="login-caption-container">
                            REPEAT PASSWORD
                            <input name="repeatPassword" type="password" placeholder="password">
                        </div>


                   <label class="checkbox">
                            <input name="checkbox" type="checkbox" checked/>
                            <span>I accept the terms and conditions</span>
                        </label>
                  
                    <div class="login-buttons-container">
                        <button type="button" class="register-button">SIGN UP</button>
                    </div>
            </form>
        </div>
    </div>
</body>
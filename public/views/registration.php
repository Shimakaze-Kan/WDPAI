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
                            <input <!--name="password"--> type="password" placeholder="password">
                        </div>
                   
                        <div class="login-caption-container">
                            COUNTRY
                            <select>
                                <option>Germany</option>
                                <option>Poland</option>
                                <option>Finland</option>
                            </select>
                        </div>
                
                    <!--<li>
                        <div class="textarea-caption-container">
                        ABOUT
                        <textarea>

                        </textarea>
                        </div>

                    </li>-->

                   <label class="checkbox">
                            <input name="checkbox" type="checkbox" checked/>
                            <span>Don't show my email to other users</span>
                        </label>
                  
                    <div class="login-buttons-container">
                        <button class="register-button">SIGN UP</button>
                    </div>
            </form>
        </div>
    </div>
</body>
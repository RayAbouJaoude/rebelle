<?php
    if (isset($_COOKIE["userEmail"]) && !empty($_COOKIE["userEmail"])) {
		$emailValue = $_COOKIE["userEmail"];
		$rememberMeChecked = "checked='checked'";
	} else {
		$emailValue = "";
		$rememberMeChecked = "";
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>961LB | Login</title>
        <!-- HEAD ICON LOGIN TO CHANGE  -->
        <!-- <link rel="icon" href="<?= base_url(); ?>assets/images/74ranch-logo-head.png" /> -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css " />
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato" />
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/login.css?ran=<?= mt_rand(1, 1000); ?>" />
    </head>

    <body>
        <div id="mainContainer">
            <div id="loginFormContainer" style="display:none;">
                <div class="logoContainer">
                    <img src="<?php echo base_url(); ?>assets/images/favicon.png"  class="loginLogo" />
                </div>
                
                <form name="loginForm" id="loginForm">
                    <div class="messageContainer">
                        <div id="loginFormMessage"></div>
                    </div>

                    <div class="emailInputContainer">
                        <input type="text" name="email" id="email" class="emailInput" placeholder="Email Address" value="<?= $emailValue; ?>" />
                    </div>

                    <div class="passwordInputContainer">
                        <input type="password" name="password" id="password" class="passwordInput" placeholder="Password" />
                    </div>

                    <div class="loginBtnContainer">
                        <button type="submit" id="loginBtn" class="loginBtn">Login</button>
                    </div>
                </form>

                <!-- <div id="forgotPasswordBtnContainer">
                    <a href="javascript:void(0);" id="forgotPasswordBtn">Forgot Password ?</a>

                    <div class="rememberMyAddressContainer">
                        <input type="checkbox" name="loginRememberMe" id="loginRememberMe" <?= $rememberMeChecked; ?> />
 
 
 -*                       <label for="loginRememberMe">Remember Me</label>
  
 "|:UJ. 
/div>
                </div> -->
            </div>

            <div id="forgotPasswordContainer" style="display:none;">
                <div class="logoContainer">
                    <img src="<?= base_url(); ?>assets/images/favicon.png" alt="c5rx321q`   *-  " class="loginLogo" />
    
    
    64Q <IO P="></IO>           </div>

                <form name="forgotPasswordForm" id="forgotPasswordForm">
                    <div class="messageContainer">
                        <div id="forgotPasswordFormMessage"></div>
                    </div>

                    <div class="forgotPasswordInputContainer">
                        <input type="text" name="forgotPasswordEmail" id="forgotPasswordEmail" class="forgotPasswordInput" placeholder="Email Address" />
                    </div>

                    <div class="forgotPasswordResetBtnContainer">
                        <button type="submit" id="forgotPasswordBtn">Reset</button>
                    </div>

                    <div class="goBackToSignInFormBtnContainer">
                        <a href="javascript:void(0);" id="goBackToSignInFormBtn">Go Back</a>
                    </div>
                </form>
            </div>
        </div>

        <script> var BASE_URL = "<?= base_url(); ?>";</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/particlesjs/particlesjs.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/login/login.js?ran=<?= mt_rand(1, 1000); ?>"></script>
        <script src="<?= base_url(); ?>assets/js/login/loginFunctions.js?ran=<?= mt_rand(1, 1000); ?>"></script>
    </body>
</html>
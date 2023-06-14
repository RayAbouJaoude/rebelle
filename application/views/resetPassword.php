<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>74 Ranch | Password Reset</title>
        
        <link rel="icon" href="<?= base_url(); ?>assets/images/74ranch-logo-head.png" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css " />
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato" />
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/login.css?ran=<?= mt_rand(1, 1000); ?>" />
    </head>

    <body>
        <div id="mainContainer">
            <div id="resetPasswordFormContainer">
                <div class="logoContainer">
                    <img src="<?= base_url(); ?>assets/images/74ranch-logo.png" alt="74 Ranch Logo" class="loginLogo" />
                </div>
                
                <form name="resetPasswordForm" id="resetPasswordForm">
                    <div class="messageContainer">
                        <div id="resetPasswordFormMessage"></div>
                    </div>

                    <input type="hidden" name="encryptedId" id="encryptedId" value="<?= $encryptedResetPasswordId; ?>" />

                    <div class="resetPasswordInputContainer">
                        <input type="password" name="resetPassword" id="resetPassword" class="resetPasswordInput" placeholder="Password" />
                    </div>

                    <div class="resetPasswordConfirmInputContainer">
                        <input type="password" name="resertPasswordConfirm" id="resertPasswordConfirm" class="resertPasswordConfirmInput" placeholder="Confirm Password" />
                    </div>

                    <div class="resetPasswordBtnContainer">
                        <button type="submit" id="resetPasswordBtn" class="resetPasswordBtn">Submit</button>
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
particlesJS.load("mainContainer", BASE_URL + "assets/js/particlesjs/particlesjs-config.json");


$(document).ready(function () {
    // ----------------------------------------------------------- //
    $("#loginFormContainer").fadeIn(500);
    

    // ----------------------------------------------------------- //
    $("#forgotPasswordBtn").click(function () {
        $("#loginFormContainer").fadeOut(500);

        setTimeout(function () {
            $("#forgotPasswordContainer").fadeIn(500);
        }, 500);
    });


    // ----------------------------------------------------------- //
    $("#goBackToSignInFormBtn").click(function () {
        $("#forgotPasswordContainer").fadeOut(500);

        $("#forgotPasswordFormMessage").html("");
        $("#forgotPasswordForm #forgotPasswordEmail").val("");

        setTimeout(function () {
            $("#loginFormContainer").fadeIn(500);
        }, 500);
    });


    // ----------------------------------------------------------- //
	$("#loginForm").on("submit", function () {
        var email = $("#loginForm #email").val();
        var password = $("#loginForm #password").val();

		if (validateLoginForm(email, password)) {
            $("#loginFormMessage").html("<i class='fas fa-info-circle'></i> Checking Your Login Information...").removeClass("greenColor").addClass("redColor");

            if ($("#loginRememberMe").prop("checked")) {
                var rememberMeFlag = 1;
            } else {
                var rememberMeFlag = 0;
            }

            var postData = {"email": email, "password": password, "rememberMeFlag": rememberMeFlag};
            loginFormSubmit(postData);
        }

		return false;
    });


    // ----------------------------------------------------------- //
	$("#forgotPasswordForm").on("submit", function () {
        var email = $("#forgotPasswordForm #forgotPasswordEmail").val();

		if (validateForgotPasswordForm(email)) {
            var postData = {"email": email};
            forgotPasswordFormSubmit(postData);
		}

		return false;
    });


    // ----------------------------------------------------------- //
	$("#resetPasswordForm").on("submit", function () {
		var resetPassword = $("#resetPasswordForm #resetPassword").val();
		var resetPasswordConfirm = $("#resetPasswordForm #resertPasswordConfirm").val();
        var encryption = $("#encryptedId").val();
        
		if (validateResetPasswordForm(resetPassword, resetPasswordConfirm)) {
            $("#resetPasswordFormMessage").html("");

            var postData = {"resetPassword": resetPassword, "resetPasswordConfirm": resetPasswordConfirm, "encryption": encryption};
            resetPasswordFormSubmit(postData);
		}

		return false;
	});
});
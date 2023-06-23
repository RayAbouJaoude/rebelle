// ----------------------------------------------------------- //
function validateLoginForm(email, password) 
{
	if(email.trim() == "") {
		$("#loginFormMessage").html("<i class='fas fa-exclamation-circle'></i> Please Enter Your Email Address.").removeClass("greenColor").addClass("redColor");
		return false;
	} else {
        if(!validateEmailAddress(email)) {
			$("#loginFormMessage").html("<i class='fas fa-exclamation-circle'></i> Please Enter a Valid Email Address.").removeClass("greenColor").addClass("redColor");
			return false;
		} else {
            $("#loginFormMessage").html("");
        }
    }
	if(password.trim() == "") {
		$("#loginFormMessage").html("<i class='fas fa-exclamation-circle'></i> Please Enter Your Password.").removeClass("greenColor").addClass("redColor");
		return false;
	} else {
        $("#loginFormMessage").html("");
    } 

	return true;
}


// ----------------------------------------------------------- //
function loginFormSubmit(postData) 
{
	$.ajax({
		method: "POST",
		url: BASE_URL + "Login/loginFormSubmit",
		data: postData,
		dataType: "JSON",
		beforeSend: function() {
			showLoader();
		},
		success: function (data) {
			var flag = data[0];
			var msg = data[1];
			
			if (flag == -1) {
				$("#loginFormMessage").html(msg).removeClass("greenColor").addClass("redColor");
			} else {
				$("#loginFormMessage").html(msg).removeClass("redColor").addClass("greenColor");
				
				window.location.href = BASE_URL + "Rebelle";
			}
		},
		error: function () {
			$("#loginFormMessage").html("<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again. (Error Code: 31)").removeClass("greenColor").addClass("redColor");
		},
		complete: function() {
			hideLoader();
		}
	});
}



// ----------------------------------------------------------- //
function validateForgotPasswordForm(email) 
{
	if(email.trim() == "") {
		$("#forgotPasswordFormMessage").html("<i class='fas fa-exclamation-circle'></i> Please Enter Your Email Address.").removeClass("greenColor").addClass("redColor");
		return false;
	} else {
        if(!validateEmailAddress(email)) {
			$("#forgotPasswordFormMessage").html("<i class='fas fa-exclamation-circle'></i> Please Enter a Valid Email Address.").removeClass("greenColor").addClass("redColor");
			return false;
		} else {
            $("#forgotPasswordFormMessage").html("");
        }
    }

	return true;
}


// ----------------------------------------------------------- //
function forgotPasswordFormSubmit(postData) {
	$.ajax({
		method: "POST",
		url: BASE_URL + "Login/forgotPasswordFormSubmit",
		data: postData,
		dataType: "JSON",
		beforeSend: function() {
			showLoader();
		},
		success: function (data) {
			var flag = data[0];
			var msg = data[1];
			
			if (flag == -1) {
				$("#forgotPasswordFormMessage").html(msg).removeClass("greenColor").addClass("redColor");
			} else {
				$("#forgotPasswordFormMessage").html(msg).removeClass("redColor").addClass("greenColor");
			}
		},
		error: function () {
			$("#forgotPasswordFormMessage").html("<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again. (Error Code: 32)").removeClass("greenColor").addClass("redColor");
		},
		complete: function() {
			hideLoader();
		}
	});
}


// ----------------------------------------------------------- //
function validateResetPasswordForm(resetPassword, resetPasswordConfirm)
{
	if(resetPassword.trim() == "") {
		$("#resetPasswordFormMessage").html("<i class='fas fa-exclamation-circle'></i> Password Is Required.").removeClass("greenColor").addClass("redColor");
		return false;
	} else {
        if(!validatePassword(resetPassword)) {
			$("#resetPasswordFormMessage").html("<i class='fas fa-exclamation-circle'></i> Password must be at least 6 characters long and must contain at least 1 upper case and 1 digit.").removeClass("greenColor").addClass("redColor");
			return false;
		}
    }

	if(resetPasswordConfirm.trim() == "") {
		$("#resetPasswordFormMessage").html("<i class='fas fa-exclamation-circle'></i> Confirm Password Is Required.").removeClass("greenColor").addClass("redColor");
		return false;
	} else {
		if (!validatePassword(resetPasswordConfirm)) {
			$("#resetPasswordFormMessage").html("<i class='fas fa-exclamation-circle'></i> Confirm Password must be at least 6 characters long and must contain at least 1 upper case and 1 digit.").removeClass("greenColor").addClass("redColor");
			return false;
		} else if (resetPassword != resetPasswordConfirm) {
			$("#resetPasswordFormMessage").html("<i class='fas fa-exclamation-circle'></i> Password and Confirm Password Do Not Match.").removeClass("greenColor").addClass("redColor");
			return false;
		}
	}

	return true;
}


// ----------------------------------------------------------- //
function resetPasswordFormSubmit(postData) {
	$.ajax({
		method: "POST",
		url: BASE_URL + "Login/resetPasswordFormSubmit",
		data: postData,
		dataType: "JSON",
		beforeSend: function() {
			showLoader();
		},
		success: function (data) {
			var flag = data[0];
			var msg = data[1];

			if (flag == -1) {
				$("#resetPasswordFormMessage").html(msg).removeClass("greenColor").addClass("redColor");
			} else {
				$("#resetPasswordForm #resetPassword, #resetPasswordForm #resertPasswordConfirm").val("");
				$("#resetPasswordFormMessage").html(msg).removeClass("redColor").addClass("greenColor");

				setTimeout(function () {
					window.location = BASE_URL + "login";
				}, 5000);
			}
		},
		error: function () {
			$("#resetPasswordFormMessage").html("<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again. (Error Code: 33)").removeClass("greenColor").addClass("redColor");
		},
		complete: function () {
			hideLoader();
		}
	});
}




// ----------------------------------------------------------- //
function showLoader() 
{
	var loader = '<div class="loaderContainer">';
	loader +=  '<i class="fas fa-spinner fa-spin"></i>';
	loader += '</div>';

	$("body").append(loader);
}


// ----------------------------------------------------------- //
function hideLoader() 
{
    $(".loaderContainer").fadeOut(500, function () {
        $(".loaderContainer").remove();
    });
}


// ----------------------------------------------------------- //
function validateEmailAddress(email){
    var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return email.match(pattern);
}


// ----------------------------------------------------------- //
function validatePassword(password) 
{
	var pattern = (/^(?=.*\d)(?=.*[A-Z])(?=.*?[#?!@$%^&*-])?[0-9a-zA-Z#?!@$%^&*-]{6,}$/);
	return password.match(pattern);
}
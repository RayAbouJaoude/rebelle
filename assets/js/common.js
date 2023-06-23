$(document).ready(function () {
    // ----------------------------------------------------------- //
    // setInterval(checkForSessionValidation, 120000);


    // ----------------------------------------------------------- //
    $("[data-toggle='tooltip']").tooltip({
        "trigger" : "hover"
    });


    // ----------------------------------------------------------- //
    $("body").on("click", "#headerLogoutBtn", function () {
        $("#logoutModal").modal("show");
    });


    // ----------------------------------------------------------- //
    $("body").on("click", "#logoutModalBtn", function () {
        window.location.href = BASE_URL + "login/logout";
	});


    // ----------------------------------------------------------- //
    $("#logoutButton").click(function(){
        $.ajax({
            url: baseURL + "/Rebelle/logoutButton",
            method: "POST",
            dataType: "json",
            beforeSend:function(){
                $(".loader").fadeIn(500);
            },
            success: function (data) {
                if(data == 1){
                    showError("Logged out successfully.");
                    setTimeout(function(){
                        window.location.href = baseURL;
                    },2500)
                }
            },
            error: function (error) {
                alert("network Error Please Refresh The Page.");
            },
            complete: function(){
                $(".loader").fadeOut();
            }
        });  
    })

});




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
function showError(errorMessage) 
{
	$("#errorModal .modal-body").html(errorMessage);
	$("#errorModal").modal();
}


// ----------------------------------------------------------- //
function showSuccess(successMessage) 
{
	$("#successModal .modal-body").html(successMessage);
	$("#successModal").modal();
}


// ----------------------------------------------------------- //
function validateEmailAddress(email)
{
    var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return email.match(pattern);
}


// // ----------------------------------------------------------- //
// // ----------------------------------------------------------- //
// function checkForSessionValidation()
// {
//     $.ajax({
//         method: "POST",
//         url: baseURL + `/Home/checkForSessionValidation`,
//         dataType: "JSON",
//         success: function(data) {
//             var flag = data;

//             if (flag == -1) {
//                 window.location.href = baseURL + "login";
//             }
//         },
//         error: function () {
//             window.location.href = baseURL + "login";
//         }
//     });
// }
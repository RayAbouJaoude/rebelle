<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model("Login_Model");
	}

	// ----------------------------------------------------------- //
	public function index() 
	{
		if (isset($_SESSION["sessionId"])) {
			redirect("Lb961");
		} else {
			$this->load->view("login");
		}
    }
    
    // ----------------------------------------------------------- //
	public function loginFormSubmit() 
	{
		if (isset($_POST["email"]) && !empty($_POST["email"])) {
			$email = $_POST["email"];
		} else {
			$msg = "<i class='fas fa-exclamation-circle'></i> Please Enter Your Email Address.";
			$flag = -1;

			echo json_encode([$flag, $msg]);
			exit();
		}

		if (isset($_POST["password"]) && !empty($_POST["password"])) {
			$password = $_POST["password"];
		} else {
			$msg = "<i class='fas fa-exclamation-circle'></i> Please Enter Your Password.";
			$flag = -1;
			
			echo json_encode([$flag, $msg]);
			exit();
		}

		if (isset($_POST["rememberMeFlag"]) && is_numeric($_POST["rememberMeFlag"])) {
			$rememberMeFlag = $_POST["rememberMeFlag"];
		} else {
			$rememberMeFlag = 0;
		}

		$userInfo = $this->Login_Model->getUserInfo($email);
		if (is_object($userInfo)) {
			$userId = $userInfo->id;
			$userPassword = $userInfo->password;

			if (password_verify($password, $userPassword)) {
				$sessionId = session_id();

				$sessionData = [
					"sessionId" => $sessionId
				];
				$this->session->set_userdata($sessionData);

				$updateSessionInfo = $this->Login_Model->updateSessionInfo($userId, $sessionId);
				if ($updateSessionInfo == 1) {
					if ($rememberMeFlag == 1) { // Add Email Cookie //
						setcookie("userEmail", $email, time() + 31536000, "/");
					} else { // Remove Email Cookie //
						if(isset($_COOKIE['scocare_user_email'])){
							setcookie("userEmail", "", time() - 3600, "/");
						}
					}

					$msg = "<i class='fas fa-check-circle'></i> Logging In...";
					$flag = 1;

					echo json_encode([$flag, $msg]);
					exit();
				} else {
					$msg = "Error Occured. Please Try Again Later. (Error Code: 12)";
					$flag = -1;

					echo json_encode([$flag, $msg]);
					exit();
				}

			} else {
				$msg = "<i class='fas fa-exclamation-circle'></i> Wrong Email Address Or Password. Please Try Again.";
				$flag = -1;
				
				echo json_encode([$flag, $msg]);
				exit();
			}
		} else {
			$msg = "<i class='fas fa-exclamation-circle'></i> Wrong Email Address Or Password. Please Try Again.";
			$flag = -1;

			echo json_encode([$flag, $msg]);
			exit();
		}
	}
    
    
    // ----------------------------------------------------------- //
	public function forgotPasswordFormSubmit() 
	{
		if (isset($_POST["email"]) && !empty($_POST["email"])) {
			$email = $_POST["email"];
		} else {
			$msg = "<i class='fas fa-exclamation-circle'></i> Please Enter Your Email Address.";
			$flag = -1;

			echo json_encode([$flag, $msg]);
			exit();
		}

		
		$result = $this->Login_Model->getUserInfo($email);

		if ($result === -1) {
			$msg = "<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again. (Error Code: 13)";
			$flag = -1;

			echo json_encode([$flag, $msg]);
			exit();
		} else if ($result === 0) {
			$msg = "<i class='fas fa-exclamation-circle'></i> The email address you entered doesn't appear to belong to an account.";
			$flag = -1;

			echo json_encode([$flag, $msg]);
			exit();
		} else {
			$userId = $result->id;
			$userFname = $result->fname;
			$userLname = $result->lname;

			$resetPasswordRequest = $this->Login_Model->resetPasswordRequest($userId);

			if ($resetPasswordRequest > 0) {
				$this->load->library("email");
				$config["mailtype"] = "html";
				$config["newline"]  = "\r\n";

				$this->email->initialize($config);

				$encryption = base64_encode($resetPasswordRequest . SALT);

				$message = "
					<p>Hi $userFname,</p>
					<p>We received a request to reset your <b>Myka</b> password:</p>

					<b>Email:</b> $email <br/><br/>

					Click <a href='" . base_url() . "login/resetPassword/$encryption'>here</a> to change your password. <br/><br/>
					
					<span style='color:red;'>
						* <b><em>This message will expire in 10 minutes.</em></b>
					</span>
					<br/><br/>

					Regards, <br/>
					74 Ranch Team
				";

				$this->email->from("no-reply@sconet.net", "74 Ranch");
				$this->email->to($email);
				$this->email->subject("Myka Foundation - Password Recovery");
				$this->email->message($message);

				if ($this->email->send()) {
					$msg = "<i class='fas fa-check-circle'></i> Please Check Your Email Inbox And Follow The Steps.";
					$flag = 1;

					echo json_encode([$flag, $msg]);
					exit();
				} else {
					$msg = "<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again. (Error Code: 15)";
					$flag = -1;

					echo json_encode([$flag, $msg]);
					exit();
				}
			} else {
				$msg = "<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again. (Error Code: 14)";
				$flag = -1;

				echo json_encode([$flag, $msg]);
				exit();
			}
		}
	}


	// ----------------------------------------------------------- //
	public function resetPassword($encryption)
	{
		$decryption = base64_decode($encryption);
		$resetPasswordId = preg_replace(sprintf("/%s/", SALT), "", $decryption);

		if ($resetPasswordId > 0) {
			$resetPasswordRequestInfo = $this->Login_Model->getResetPasswordRequestInfo($resetPasswordId);

			if (is_object($resetPasswordRequestInfo)) {
				$userId = $resetPasswordRequestInfo->user_id;
				$requestedOn = $resetPasswordRequestInfo->requested_on;
				$status = $resetPasswordRequestInfo->status;

				$timeNow = time();

				if ($status != "P") {
					$data["msg"] = "<i class='fas fa-exclamation-circle'></i> This link is invalid or has expired. (Error Code: 18)";

					echo $this->load->view("error_template/index", $data, TRUE);
					exit();
				}

				if($timeNow > $requestedOn + 600){
					$data["msg"] = "<i class='fas fa-exclamation-circle'></i> This link is invalid or has expired. (Error Code: 19)";

					echo $this->load->view("error_template/index", $data, TRUE);
					exit();
				}

				$data["encryptedResetPasswordId"] = $encryption;
				$this->load->view("resetPassword", $data);
			} else {
				$data["msg"] = "<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again. (Error Code: 17)";

				echo $this->load->view("error_template/index", $data, TRUE);
				exit();
			}
		} else {
			$data["msg"] = "<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again. (Error Code: 16)";

			echo $this->load->view("error_template/index", $data, TRUE);
			exit();
		}
	}


	// ----------------------------------------------------------- //
	public function resetPasswordFormSubmit()
	{
		$msg = "";
		$flag = 0;

		$pattern = "/^(?=.*\d)(?=.*[A-Z])(?=.*?[#?!@$%^&*-])?[0-9a-zA-Z#?!@$%^&*-]{6,}$/";

		if (isset($_POST["resetPassword"]) && !empty($_POST["resetPassword"])) {
			$resetPassword = $_POST["resetPassword"];

			if (!preg_match($pattern, $resetPassword)) {
				$msg = "<i class='fas fa-exclamation-circle'></i> Password must be at least 6 characters long and must contain at least 1 upper case and 1 digit.";
				$flag = -1;

				echo json_encode([$flag, $msg]);
				exit();
			}
 		} else {
			$msg = "<i class='fas fa-exclamation-circle'></i> Password Is Required.";
			$flag = -1;

			echo json_encode([$flag, $msg]);
			exit();
		}

		if (isset($_POST["resetPasswordConfirm"]) && !empty($_POST["resetPasswordConfirm"])) {
			$resetPasswordConfirm = $_POST["resetPasswordConfirm"];

			if (!preg_match($pattern, $resetPasswordConfirm)) {
				$msg = "<i class='fas fa-exclamation-circle'></i> Confirm Password must be at least 6 characters long and must contain at least 1 upper case and 1 digit.";
				$flag = -1;

				echo json_encode([$flag, $msg]);
				exit();
			} else if ($resetPasswordConfirm != $resetPassword) {
				$msg = "<i class='fas fa-exclamation-circle'></i> Password and Confirm Password Do Not Match.";
				$flag = -1;

				echo json_encode([$flag, $msg]);
				exit();
			}
		} else {
			$msg = "<i class='fas fa-exclamation-circle'></i> Confirm Password Is Required.";
			$flag = -1;

			echo json_encode([$flag, $msg]);
			exit();
		}

		if (isset($_POST["encryption"]) && !empty($_POST["encryption"])) {
			$encryption = $_POST["encryption"];
		} else {
			$msg = "<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again. (Error Code: 20)";
			$flag = -1;

			echo json_encode([$flag, $msg]);
			exit();
		}

		$decryption = base64_decode($encryption);
		$resetPasswordId = preg_replace(sprintf("/%s/", SALT), "", $decryption);

		if ($resetPasswordId > 0) {
			$resetPasswordRequestInfo = $this->Login_Model->getResetPasswordRequestInfo($resetPasswordId);

			if (is_object($resetPasswordRequestInfo)) {
				$userId = $resetPasswordRequestInfo->user_id;
				$encryptedPassword = password_hash($resetPassword, PASSWORD_BCRYPT);
				
				$updatePassword = $this->Login_Model->resetPasswordFormSubmit($resetPasswordId, $userId, $encryptedPassword);

				if ($updatePassword == 1) {
					$msg = "<i class='fas fa-check-circle'></i> Your Password Has Been Successfully Changed.";
					$flag = 1;

					echo json_encode([$flag, $msg]);
					exit();
				} else {
					$msg = "<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again Later. (Error Code: 23)";
					$flag = -1;

					echo json_encode([$flag, $msg]);
					exit();
				}
			} else {
				$msg = "<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again Later. (Error Code: 22)";
				$flag = -1;

				echo json_encode([$flag, $msg]);
				exit();
			}
		} else {
			$msg = "<i class='fas fa-exclamation-circle'></i> Error Occured. Please Try Again. (Error Code: 21)";
			$flag = -1;

			echo json_encode([$flag, $msg]);
			exit();
		}
	}

	// ----------------------------------------------------------- //
	public function logout()
	{
		$userId = $_SESSION["userId"];
		$clearSession = $this->Login_Model->clearSession($userId);

		redirect("login");
	}
}
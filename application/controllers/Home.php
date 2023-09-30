<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Login_Model");
	}

	public function index()
	{
		$data["page"] = "home";
		$data["cssLinks"] = "<link rel='stylesheet' href='".base_url()."/assets/css/home.css?ran=" . rand(1, 100000) . "' />";
		$data["scripts"] = "<script src='".base_url()."/assets/js/home.js?ran=" . rand(1, 100000) . "'></script>";
		
		$this->load->view('common/template', $data);
	}

	public function createAccount()
	{
		$error = 0;
		if(isset($_POST["emailMainPage"]) && !empty($_POST["emailMainPage"])){
            $emailMainPage = $_POST["emailMainPage"];
        }else{
            $error = 1;
		}
		if(isset($_POST["passwordMainPage"]) && !empty($_POST["passwordMainPage"])){
            $passwordMainPage = $_POST["passwordMainPage"];
			$passwordMainPage = password_hash($passwordMainPage, PASSWORD_BCRYPT);
        }else{
            $error = 2;
		}
		$this->load->model("Home_Model");
		if($error == 0){
			$transactionType = $this->Home_Model->createAccount($emailMainPage, $passwordMainPage);
		}

		echo json_encode($transactionType);
	}

	public function addToCart()
	{
		$error = 0;
		if(isset($_POST["itemBarCode"]) && !empty($_POST["itemBarCode"])){
            $itemBarCode = $_POST["itemBarCode"];
        }else{
            $error = 1;
		}
		if(isset($_POST["itemSize"]) && !empty($_POST["itemSize"])){
            $itemSize = $_POST["itemSize"];
        }else{
            $error = 1;
		}
		if(isset($_POST["quantity"]) && !empty($_POST["quantity"])){
            $quantity = $_POST["quantity"];
        }else{
            $error = 1;
		}
		if(isset($_POST["color"]) && !empty($_POST["color"])){
            $color = $_POST["color"];
        }else{
            $error = 1;
		}
		
	
		
		if($error == 0){
			if(isset($_SESSION["userId"]) && !empty($_SESSION["userId"])){
				$userId = $_SESSION["userId"];
				$this->load->model("Home_Model");
				$addToCart = $this->Home_Model->addToCart($itemBarCode, $itemSize, $quantity, $userId, $color );
				if($addToCart == -1){
					$error = 2;
				}
			}
			// else{
			// 	$_SESSION["sessionId"] =  session_id();
			// 	$sessionId = $_SESSION["sessionId"];
			// 	$this->load->model("Home_Model");
			// 	$createUserToAddCart = $this->Home_Model->createUserToAddCart($itemBarCode, $itemSize, $quantity, $sessionId, $color);
			// 	if($createUserToAddCart == -1){
			// 		$error =2;
			// 	}
			// }
			
		}
		echo json_encode($error);
	}

	public function drawCart()
	{
		if(isset($_SESSION["userId"]) && !empty($_SESSION["userId"])){
			$userId = $_SESSION["userId"];
			$this->load->model("Home_Model");
			$itemsData = $this->Home_Model->drawCart($userId);
			if ($itemsData == -1){
				$itemsDisplayed = -1;
			}else{
				$data["itemsData"] = $itemsData[0];
				$data["currencyData"] = array(1, "$");
				$itemsDisplayed = $this->load->view("displayCart", $data, TRUE);
			}
		}else{
			$itemsDisplayed = -1;
		}
		echo json_encode($itemsDisplayed);
	}

	public function drawTotalInPurchaseCartModal()
	{
		if(isset($_SESSION["userId"]) && !empty($_SESSION["userId"])){
			$userId = $_SESSION["userId"];
			$this->load->model("Home_Model");
			$total = $this->Home_Model->drawTotalInPurchaseCartModal($userId);
			
		}
		echo json_encode($total);
	}

	public function removeItemFromCart()
	{
		$error = 0;
		if(isset($_POST["itemId"]) && !empty($_POST["itemId"])){
            $itemId = $_POST["itemId"];
        }else{
            $error = 1;
		}		
		
		if($error == 0){
			$this->load->model("Home_Model");
			$itemsData = $this->Home_Model->removeItemFromCart($itemId);
			
		}
		echo json_encode($itemsData);
	}

	public function changeItemQuantityFromCart()
	{
		$error = 0;
		if(isset($_POST["itemId"]) && !empty($_POST["itemId"])){
            $itemId = $_POST["itemId"];
        }else{
            $error = 1;
		}
		if(isset($_POST["quantity"]) && !empty($_POST["quantity"])){
            $quantity = $_POST["quantity"];
        }else{
            $quantity = 0;
		}
		if($error == 0){
			$this->load->model("Home_Model");
			$itemsData = $this->Home_Model->changeItemQuantityFromCart($itemId, $quantity);
		}
		echo json_encode($itemsData);
	}


	public function purchaseCart()
	{
		$result = -1;
		$msg = "";

		if(isset($_SESSION["userId"]) && !empty($_SESSION["userId"])){
			$userId = $_SESSION["userId"];

			if(isset($_POST["customerFullNameInPurchaseCartModal"]) && !empty($_POST["customerFullNameInPurchaseCartModal"])){
				$name = $_POST["customerFullNameInPurchaseCartModal"];
			}else{
				$msg = "The Full Name field is required.";
				$flag = -1;
	
				echo json_encode([$flag, $msg]);
				exit();
			}	

			if(isset($_POST["telephoneInPurchaseCartModal"]) && !empty($_POST["telephoneInPurchaseCartModal"])){
				$phoneNumber = $_POST["telephoneInPurchaseCartModal"];
				$phoneNumber = str_replace(' ', '', $phoneNumber);

			}else{
				$msg = "The Full Name field is required.";
				$flag = -1;
	
				echo json_encode([$flag, $msg]);
				exit();
			}
			$country = "LB";
			if ($country == "LB") {
				$localShippingFlag = 1;

				$state = "";
				$city = "";
				$zipCode = "";
				$email = "";
				if(isset($_POST["addressInPurchaseCartModal"]) && !empty($_POST["addressInPurchaseCartModal"])){
					$address = $_POST["addressInPurchaseCartModal"];
				}else{
					$msg = "The Address field is required.";
					$flag = -1;
		
					echo json_encode([$flag, $msg]);
					exit();
				}

			} else {

				$localShippingFlag = 0;

				$address = "";

				if(isset($_POST["purchaseCartState"]) && !empty($_POST["purchaseCartState"])){
					$address = $_POST["purchaseCartState"];
				}else{
					$msg = "The State field is required.";
					$flag = -1;
		
					echo json_encode([$flag, $msg]);
					exit();
				}

				if(isset($_POST["purchaseCartCity"]) && !empty($_POST["purchaseCartCity"])){
					$address = $_POST["purchaseCartCity"];
				}else{
					$msg = "The City field is required.";
					$flag = -1;
		
					echo json_encode([$flag, $msg]);
					exit();
				}

				if(isset($_POST["purchaseCartZipCode"]) && !empty($_POST["purchaseCartZipCode"])){
					$address = $_POST["purchaseCartZipCode"];
				}else{
					$msg = "The Zip Code field is required.";
					$flag = -1;
		
					echo json_encode([$flag, $msg]);
					exit();
				}
			}

			$this->load->model("Home_Model");

			$result = $this->Home_Model->purchaseCart($userId, $name, $phoneNumber, $address, $city, $state, $zipCode, $localShippingFlag);
			
		}
		echo json_encode([$result, $msg]);
	}
	

//........................Last One............................................//
}

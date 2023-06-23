<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rebelle extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model("Login_Model");
		
		if (isset($_SESSION["sessionId"])) {
			$sessionId = $_SESSION["sessionId"];
			
			$this->load->model("Home_Model");
			
			$sessionInfo = $this->Login_Model->getUserInfoFromSession($sessionId);
			if (is_object($sessionInfo)) {
				$this->userId = $sessionInfo->id;
				$this->userFname = $sessionInfo->fname;
				$this->userLname = $sessionInfo->lname;
				$this->userType = $sessionInfo->user_type;
				$prevSessionId = $sessionInfo->session_id;
				$sessionTime = $sessionInfo->session_time;
				$_SESSION["userId"] = $sessionInfo->id;
				$_SESSION["userFname"] = $sessionInfo->fname;
				$_SESSION["userLname"] = $sessionInfo->lname;
				$_SESSION["email"] = $sessionInfo->email;
				$_SESSION["dateOfBirth"] = $sessionInfo->dateOfBirth;
				$_SESSION["gender"] = $sessionInfo->gender;
				$_SESSION["userType"] = $sessionInfo->user_type;
				$_SESSION["phoneNumber"] = $sessionInfo->phoneNumber;
				$_SESSION["description"] = $sessionInfo->description;

				$timeNow = time();

				if ($timeNow > ($sessionTime + SESSION_TIME)) {
					$this->Login_Model->clearSession($this->userId);
			
					header("Location:" . base_url() . "login");
					exit();
				}else{
					$updateSessionTime = $this->Login_Model->updateSessionTime($this->userId, $timeNow);
		
					if ($updateSessionTime == -1) {
						$this->Login_Model->clearSession($this->userId);
		
						header("Location:" . base_url() . "login");
						exit();
					}
				}
			}else{
				$this->Login_Model->clearSession($this->userId);
				header("Location:" . base_url() . "login");
				exit();
			}
		} else {
			$this->Login_Model->clearSession($this->userId);
			header("Location:" . base_url() . "login");
			exit();
		}
	}

	public function index()
	{
		$data["page"] = "lb961";
		$data["cssLinks"] = "<link rel='stylesheet' href='".base_url()."/assets/css/home.css?ran=" . rand(1, 100000000) . "' />";
		$data["scripts"] = "<script src='".base_url()."/assets/js/home.js?ran=" . rand(1, 100000000) . "'></script>";
		
		$this->load->view('common/template', $data);
	}

	public function logoutButton() {
		session_destroy();
		echo json_encode("1");
	}

	public function submitProperty()
	{
		
		$error = 0;
		if(isset($_SESSION["userId"]) ){
			$userId = $_SESSION["userId"];
		}else{
			$error = 99;
		}
		if(isset($_POST["propertyIdHidden"]) && !empty($_POST["propertyIdHidden"])){
			$propertyIdHidden = $_POST["propertyIdHidden"];
		}else{
			$propertyIdHidden = "";
		}
		if(isset($_POST["propertyTitle"]) && !empty($_POST["propertyTitle"])){
			$propertyTitle = $_POST["propertyTitle"];
		}else{
			$error = 1;
		}
		if(isset($_POST["propertyDescription"]) && !empty($_POST["propertyDescription"])){
			$propertyDescription = $_POST["propertyDescription"];
		}else{
			$error = 2;
		}
		if(isset($_POST["propertyPrice"]) && !empty($_POST["propertyPrice"])){
			$propertyPrice = $_POST["propertyPrice"];
		}else{
			$error = 3;
		}
		if(isset($_POST["propertyAddress"]) && !empty($_POST["propertyAddress"])){
			$propertyAddress = $_POST["propertyAddress"];
		}else{
			$error = 4;
		}
		// if(isset($_POST["propertyListingStatus"]) && !empty($_POST["propertyListingStatus"])){
		// 	$propertyListingStatus = $_POST["propertyListingStatus"];
		// }else{
		// 	$error = 5;
		// }
		$propertyListingStatus = "";
		if(isset($_POST["propertyZipcode"]) && !empty($_POST["propertyZipcode"])){
			$propertyZipcode = $_POST["propertyZipcode"];
		}else{
			$error = 6;
		}
		if(isset($_POST["propertyLotSize"]) && !empty($_POST["propertyLotSize"])){
			$propertyLotSize = $_POST["propertyLotSize"];
		}else{
			$error = 7;
		}
		if(isset($_POST["propertySaleOrRent"]) && !empty($_POST["propertySaleOrRent"])){
			$propertySaleOrRent = $_POST["propertySaleOrRent"];
		}else{
			$error = 8;
		}
		if(isset($_POST["propertyYearBuilt"]) && !empty($_POST["propertyYearBuilt"])){
			$propertyYearBuilt = $_POST["propertyYearBuilt"];
		}else{
			$error = 9;
		}
		if(isset($_POST["propertyNumberOfBedrooms"]) && !empty($_POST["propertyNumberOfBedrooms"])){
			$propertyNumberOfBedrooms = $_POST["propertyNumberOfBedrooms"];
		}else{
			$error = 10;
		}
		if(isset($_POST["propertyCounterAddOrEdit"]) && !empty($_POST["propertyCounterAddOrEdit"])){
			$propertyCounterAddOrEdit = $_POST["propertyCounterAddOrEdit"];
		}else{
			$error = 11;
		}
		if(isset($_POST["longitude"]) && !empty($_POST["longitude"])){
			$longitude = $_POST["longitude"];
		}else{
			$error = 12;
		}
		if(isset($_POST["latitude"]) && !empty($_POST["latitude"])){
			$latitude = $_POST["latitude"];
		}else{
			$error = 13;
		}
		if(isset($_POST["areaPoolCheckbox"]) && !empty($_POST["areaPoolCheckbox"])){
			$areaPoolCheckbox = 1;
		}else{
			$areaPoolCheckbox = 0;
		}
		if(isset($_POST["areaTennisCheckbox"]) && !empty($_POST["areaTennisCheckbox"])){
			$areaTennisCheckbox = 1;
		}else{
			$areaTennisCheckbox = 0;
		}
		if(isset($_POST["elevatorCheckbox"]) && !empty($_POST["elevatorCheckbox"])){
			$elevatorCheckbox = 1;
		}else{
			$elevatorCheckbox = 0;
		}
		if(isset($_POST["energyFeatureCheckbox"]) && !empty($_POST["energyFeatureCheckbox"])){
			$energyFeatureCheckbox = 1;
		}else{
			$energyFeatureCheckbox = 0;
		}
		if(isset($_POST["garageAptCheckbox"]) && !empty($_POST["garageAptCheckbox"])){
			$garageAptCheckbox = 1;
		}else{
			$garageAptCheckbox = 0;
		}
		if(isset($_POST["lakeCheckbox"]) && !empty($_POST["lakeCheckbox"])){
			$lakeCheckbox = 1;
		}else{
			$lakeCheckbox = 0;
		}
		if(isset($_POST["privatePoolCheckbox"]) && !empty($_POST["privatePoolCheckbox"])){
			$privatePoolCheckbox = 1;
		}else{
			$privatePoolCheckbox = 0;
		}
		if(isset($_POST["spaCheckbox"]) && !empty($_POST["spaCheckbox"])){
			$spaCheckbox = 1;
		}else{
			$spaCheckbox = 0;
		}
		if(isset($_POST["wheelChairCheckbox"]) && !empty($_POST["wheelChairCheckbox"])){
			$wheelChairCheckbox = 1;
		}else{
			$wheelChairCheckbox = 0;
		}
		if(isset($_POST["yardCheckbox"]) && !empty($_POST["yardCheckbox"])){
			$yardCheckbox = 1;
		}else{
			$yardCheckbox = 0;
		}
		$this->load->model("Home_Model");
		if($propertyCounterAddOrEdit == 1){
			$data = $this->Home_Model->submitPropertyAdd($userId, $propertyAddress, $propertyTitle, $propertyDescription, $propertyPrice, $propertyListingStatus, $propertyZipcode, $propertyLotSize, $propertySaleOrRent, $propertyYearBuilt, $propertyNumberOfBedrooms, $longitude, $latitude);
		}else{
			$data = $this->Home_Model->submitPropertyEdit($userId, $propertyAddress, $propertyTitle, $propertyIdHidden, $propertyDescription, $propertyPrice, $propertyListingStatus, $propertyZipcode, $propertyLotSize, $propertySaleOrRent, $propertyYearBuilt, $propertyNumberOfBedrooms, $longitude, $latitude);
		}
		echo json_encode($data);
	}


	public function getAllPropertiesInBackEnd()
	{
		$error = 0;
		if(isset($_SESSION["userId"]) ){
			$userId = $_SESSION["userId"];
		}else{
			$error = 99;
		}
		if($error == 0){
			$this->load->model("Home_Model");
			$getAllPropertiesInBackEnd = $this->Home_Model->getAllPropertiesInBackEnd($userId);
			$data["propertyInfo"] = $getAllPropertiesInBackEnd;
			$toDraw = $this->load->view("drawAllPropertyTable", $data, TRUE);
			echo json_encode($toDraw);
		}else{
			echo json_encode($error);

		}
	}	

	public function getAllPropertiesForAdmin()
	{
		$error = 0;
		if(isset($_SESSION["userId"]) ){
			$userId = $_SESSION["userId"];
		}else{
			$error = 99;
		}
		if($error == 0){
			$this->load->model("Home_Model");
			$getAllPropertiesForAdmin = $this->Home_Model->getAllPropertiesForAdmin($userId);
			$data["propertyInfo"] = $getAllPropertiesForAdmin;
			$toDraw = $this->load->view("drawAllPropertyTableForAdmin", $data, TRUE);
			echo json_encode($toDraw);
		}else{
			echo json_encode($error);

		}
	}

	public function statusIcon()
	{
		$error =0;
		if(isset($_POST["isChecked"]) && !empty($_POST["isChecked"])){
            $isChecked = $_POST["isChecked"];
        }else{
            $isChecked = 0;
		}
		if(isset($_POST["dataId"]) && !empty($_POST["dataId"])){
            $dataId = $_POST["dataId"];
        }else{
            $error = 1;
		}
		if(isset($_SESSION["userId"]) && !empty($_SESSION["userId"])){
            $userId = $_SESSION["userId"];
        }else{
            $error = 1;
		}
		if(isset($_SESSION["userFname"]) && !empty($_SESSION["userFname"])){
            $userFname = $_SESSION["userFname"];
        }else{
            $error = 1;
		}
		
		$sectionId = 1;
		if($error == 0){
			$this->load->model("Home_Model");
			$statusIcon = $this->Home_Model->statusIcon($isChecked, $dataId, $userId, $userFname);
		}
		echo json_encode($statusIcon);	
	}


	public function displayPropertyToEdit(){
		$error = 0;
		if(isset($_POST["id"]) && !empty($_POST["id"])){
			$id = $_POST["id"];
		}else{
			$error = "";
		}
		if($error == 0){
			$this->load->model("Home_Model");
			$displayPropertyToEdit = $this->Home_Model->displayPropertyToEdit($id);
			echo json_encode($displayPropertyToEdit);
		}else{
			echo json_encode($error);
		}
	}


	public function deleteProperty()
	{
		$error = 0;
		if(isset($_POST["idToDelete"]) && !empty($_POST["idToDelete"])){
            $idToDelete = $_POST["idToDelete"];
        }else{
            $error = 1;
		}
		
		$this->load->model("Home_Model");
		if($error == 0){
			$transactionType = $this->Home_Model->deleteProperty($idToDelete);
		}
		echo json_encode($error);
	}

	public function deletePropertyInAdmin()
	{
		$error = 0;
		if(isset($_POST["idToDelete"]) && !empty($_POST["idToDelete"])){
            $idToDelete = $_POST["idToDelete"];
        }else{
            $error = 1;
		}
		
		$this->load->model("Home_Model");
		if($error == 0){
			$transactionType = $this->Home_Model->deletePropertyInAdmin($idToDelete);
		}
		echo json_encode($error);
	}


	public function displayAllPins() {
		$this->load->model("Home_Model");
		$displayAllPins = $this->Home_Model->displayAllPins();
		echo json_encode($displayAllPins);
	}	


	public function uploadFiles(){
		$succ = 0;
		$transactionId = $_POST['transactionId'];
        $curr_attached_files_count = count($_FILES);
            foreach ($_FILES as $fileindex => $files) {
                $filename = str_replace(' ', '_', $files['name']);
				$parts = explode('.', $files['name']);
                $last = array_pop($parts);
                $parts = array(implode('.', $parts), $last);
                $name = $parts[0];
                $extension = end($parts);
                $result = $this->Home_Model->uploadFiles($name,$transactionId ,$extension);
                $files['name'] = $result . '.' . $extension;
                $config['upload_path'] = FCPATH.'/assets/propertyImages';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|xlsx|docx|pdf|txt|xls';
                $config['file_name'] = $result . '.' . $extension;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $data = array('upload_data' => $this->upload->data());
                if (!$this->upload->do_upload($fileindex)) {
                    $delete_attachment = $this->Home_Model->deleteAttachment($result);
                    // $error = array('error' => $this->upload->display_errors());
                    // echo($result);
                }else{
                    $succ++;
                    // echo(-1);
                }
            }
        if($succ == $curr_attached_files_count){
            $flag = 1;
            $msg = "File(s) successfully uploaded.";
            echo json_encode([$flag, $msg]);
            return false;
        }else{
            $flag = -1;
            $msg = $this->upload->display_errors('', '');
            echo json_encode([$flag, $msg]);
            return false;
        }
    }

//........................Last One............................................//
}

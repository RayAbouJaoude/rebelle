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
		$data["page"] = "rebelle";
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



	//........................ADD ITEMS..........................//
	public function addItem()
	{
		$error = 0;
		if(isset($_POST["itemNameToAdd"]) && !empty($_POST["itemNameToAdd"])){
            $itemNameToAdd = $_POST["itemNameToAdd"];
        }else{
            $error = 1;
		}
		if(isset($_POST["itemDescriptionToAdd"]) && !empty($_POST["itemDescriptionToAdd"])){
            $itemDescriptionToAdd = $_POST["itemDescriptionToAdd"];
        }else{
            $error = 2;
		}
		if(isset($_POST["itemQuantityToAdd"]) && !empty($_POST["itemQuantityToAdd"])){
            $itemQuantityToAdd = $_POST["itemQuantityToAdd"];
        }else{
            $itemQuantityToAdd = 0;
		}
		if(isset($_POST["itemBarCodeToAdd"]) && !empty($_POST["itemBarCodeToAdd"])){
            $itemBarCodeToAdd = $_POST["itemBarCodeToAdd"];
        }else{
            $error = 3;
		}
		if(isset($_POST["itemCategoryToAdd"]) && !empty($_POST["itemCategoryToAdd"])){
            $itemCategoryToAdd = $_POST["itemCategoryToAdd"];
        }else{
            $error = 4;
		}
		// if(isset($_POST["itemGenderToAdd"]) && !empty($_POST["itemGenderToAdd"])){
        //     $itemGenderToAdd = $_POST["itemGenderToAdd"];
        // }else{
        //     $error = 5;
		// }
		if(isset($_POST["itemSizeToAdd"]) && !empty($_POST["itemSizeToAdd"])){
            $itemSizeToAdd = $_POST["itemSizeToAdd"];
        }else{
            $error = 6;
		}
		if(isset($_POST["itemWeightToAdd"]) && !empty($_POST["itemWeightToAdd"])){
            $itemWeightToAdd = $_POST["itemWeightToAdd"];
        }else{
            $error = 11;
		}
		// if(isset($_POST["itemCostToAdd"]) && !empty($_POST["itemCostToAdd"])){
        //     $itemCostToAdd = $_POST["itemCostToAdd"];
        // }else{
        //     $error = 12;
		// }
		if(isset($_POST["itemPriceToAdd"]) && !empty($_POST["itemPriceToAdd"])){
            $itemPriceToAdd = $_POST["itemPriceToAdd"];
        }else{
            $error = 13;
		}
		if(isset($_POST["colorToAdd"]) && !empty($_POST["colorToAdd"])){
            $colorToAdd = $_POST["colorToAdd"];
        }else{
            $error = 14;
		}
		if(isset($_POST["quantityArr"]) && !empty($_POST["quantityArr"])){
			$quantityArr = $_POST["quantityArr"];
        }else{
            $quantityArr = [];
		}
		if(isset($_POST["sizeArr"]) && !empty($_POST["sizeArr"])){
			$sizeArr = $_POST["sizeArr"];
        }else{
            $sizeArr = [];
		}
		if(isset($_POST["colorArr"]) && !empty($_POST["colorArr"])){
			$colorArr = $_POST["colorArr"];
        }else{
            $colorArr = [];
		}
	
		$itemId="";
		$lastId="";
		if($error == 0){
			$this->load->model("Home_Model");
			$addItem = $this->Home_Model->addItem($itemNameToAdd, $itemDescriptionToAdd, $itemQuantityToAdd, $itemBarCodeToAdd, $itemCategoryToAdd, $itemSizeToAdd, $itemPriceToAdd, $quantityArr, $sizeArr, $colorArr, $colorToAdd, $itemWeightToAdd);
			if ($addItem[0] == 1){
				$itemId = $addItem[1];
			}else{
				$error =2;
				$addItem = 0;
			}
		}else{
			$msg = "Please insert all required fields.";
		}
		echo json_encode(array($error, $itemId));
	}


	//..........................GET DATA SECTION....................................//
	public function getItemsData()
	{
		if(isset($_POST["archivedOrNot"]) && !empty($_POST["archivedOrNot"])){
			$archivedOrNot = $_POST["archivedOrNot"];
		}else{
			$archivedOrNot = 1;
		}
		if(isset($_POST["category"]) && !empty($_POST["category"])){
			$category = $_POST["category"];
		}else{
			$category = 1;
		}
		if(isset($_POST["gender"]) && !empty($_POST["gender"])){
			$gender = $_POST["gender"];
		}else{
			$gender = 1;
		}
		if(isset($_POST["showImage"]) && !empty($_POST["showImage"])){
			$showImage = $_POST["showImage"];
		}else{
			$showImage = 0;
		}
		if(isset($_POST["checkBoxForDescription"]) && !empty($_POST["checkBoxForDescription"])){
			$checkBoxForDescription = $_POST["checkBoxForDescription"];
		}else{
			$checkBoxForDescription = "";
		}
		
		$this->load->model("Home_Model");

		$itemsData = $this->Home_Model->getItemsData($archivedOrNot, $category, $gender);
		
		$data["itemsData"] = $itemsData;
		$data["showImage"] = $showImage;
		$data["checkBoxForDescription"] = $checkBoxForDescription;
		$itemsTable = $this->load->view("itemsMainTable", $data, TRUE);

		echo json_encode($itemsTable);
	}

	public function getItemDataInItemsToEdit()
	{
		$error = 0;
		if(isset($_POST["itemId"]) && !empty($_POST["itemId"])){
			$itemId = $_POST["itemId"];
		}else{
			$error = 1;
		}		
		if(isset($_POST["barCode"]) && !empty($_POST["barCode"])){
			$barCode = $_POST["barCode"];
		}else{
			$error = 1;
		}	
		if($error == 0){
			$this->load->model("Home_Model");
			$getItemDataInItemsToEdit = $this->Home_Model->getItemDataInItemsToEdit($itemId, $barCode);
		}
		
		echo json_encode($getItemDataInItemsToEdit);
	}

	public function changeTopSpeedIcon()
	{
		$error = 0;
		if(isset($_POST["cartId"]) && !empty($_POST["cartId"])){
			$cartId = $_POST["cartId"];
		}else{
			$error = 1;
		}		
		if($error == 0){
			$this->load->model("Home_Model");
			$changeOctopusIcon = $this->Home_Model->changeTopSpeedIcon($cartId);
			
		}
		echo json_encode($changeOctopusIcon);
	}

	public function newCollectionItem()
	{
		$error = 0;
		if(isset($_POST["itemId"]) && !empty($_POST["itemId"])){
			$itemId = $_POST["itemId"];
		}else{
			$error = 1;
		}	
		if($error == 0){
			$this->load->model("Home_Model");
			$newCollectionItem = $this->Home_Model->newCollectionItem($itemId);
			$sectionId = 3;
			$auditActionId = $newCollectionItem;
			$title = "New Collection";
			$beforeAfter = "";
		}
		
		echo json_encode($newCollectionItem);
	}

	public function deleteMainPageItems()
	{
		$error = 0;
		if(isset($_POST["arrayToAddStorage"]) && !empty($_POST["arrayToAddStorage"])){
            $arrayToAddStorage = $_POST["arrayToAddStorage"];
        }else{
            $error = 1;
		}
		$this->load->model("Home_Model");
		if($error == 0){
			$deleteMainPageItems = $this->Home_Model->deleteMainPageItems($arrayToAddStorage);
		}
		echo json_encode($error);
	}

	public function archiveItem()
	{
		$error = 0;
		if(isset($_POST["itemId"]) && !empty($_POST["itemId"])){
			$itemId = $_POST["itemId"];
		}else{
			$error = 1;
		}		
		if($error == 0){
			$this->load->model("Home_Model");
			$archiveItem = $this->Home_Model->archiveItem($itemId);
			
		}
		
		echo json_encode($archiveItem);
	}

	public function exportedItem()
	{
		$error = 0;
		if(isset($_POST["itemId"]) && !empty($_POST["itemId"])){
			$itemId = $_POST["itemId"];
		}else{
			$error = 1;
		}	
		if($error == 0){
			$this->load->model("Home_Model");
			$exportedItem = $this->Home_Model->exportedItem($itemId);
			$sectionId = 4;
			$auditActionId = $exportedItem;
			$title = "Exported";
			$beforeAfter = "";
		}
		
		echo json_encode($exportedItem);
	}


	public function getItemSizeInModal(){
		
		$this->load->model("Home_Model");
		$imagesData = $this->Home_Model->getItemSizeInModal();
		$data["imagesData"] = $imagesData;
		$drawImagesTable = $this->load->view("drawSizeTable", $data, TRUE);
		echo json_encode($drawImagesTable);
	}

	public function getItemColorInModal(){
		
		$this->load->model("Home_Model");
		$imagesData = $this->Home_Model->getItemColorInModal();
		$data["imagesData"] = $imagesData;
		$drawImagesTable = $this->load->view("drawColorTable", $data, TRUE);
		echo json_encode($drawImagesTable);
	}

	// -- -- -- -- -- -- -- -- -- -- -- //
	public function fillColor()
	{
		$this->load->model("Home_Model");
		$data = $this->Home_Model->fillColor();

		echo json_encode($data);
		exit();
	}
	// -- -- -- -- -- -- -- -- -- -- -- //
	public function fillSize()
	{
		$this->load->model("Home_Model");
		$data = $this->Home_Model->fillSize();

		echo json_encode($data);
		exit();
	}


	public function submitSize()
	{	
		if(isset($_POST["addOrEditCounterInModal"]) && !empty($_POST["addOrEditCounterInModal"])){
			$addOrEditCounterInModal = $_POST["addOrEditCounterInModal"];
		}else{
			$addOrEditCounterInModal = "";
		}	
		if(isset($_POST["sizeIdHidden"]) && !empty($_POST["sizeIdHidden"])){
			$sizeIdHidden = $_POST["sizeIdHidden"];
		}else{
			$sizeIdHidden = "";
		}	
		
		if(isset($_POST["sizeNameToAddInModal"]) && !empty($_POST["sizeNameToAddInModal"])){
			$sizeNameToAddInModal = $_POST["sizeNameToAddInModal"];
		}else{
			$sizeNameToAddInModal = "";
		}	
		
		$this->load->model("Home_Model");
		if($addOrEditCounterInModal == 1){
			$data = $this->Home_Model->submitSizeAdd($sizeNameToAddInModal);
			echo json_encode($data);
		}else{
			if($sizeIdHidden > 0){
				$data = $this->Home_Model->submitSizeEdit($sizeIdHidden, $sizeNameToAddInModal);
				echo json_encode($data);
			}else{
				echo json_encode(-1);
			}
		}
	}

	public function deleteSizeInModal()
	{
		$error = 0;
		if(isset($_POST["dataId"]) && !empty($_POST["dataId"])){
            $dataId = $_POST["dataId"];
        }else{
            $error = 1;
		}
		
		$this->load->model("Home_Model");
		if($error == 0){
			$transactionType = $this->Home_Model->deleteSizeInModal($dataId);
		}

		echo json_encode($error);
	}


	public function deleteColorInModal()
	{
		$error = 0;
		if(isset($_POST["dataId"]) && !empty($_POST["dataId"])){
            $dataId = $_POST["dataId"];
        }else{
            $error = 1;
		}
		
		$this->load->model("Home_Model");
		if($error == 0){
			$transactionType = $this->Home_Model->deleteColorInModal($dataId);
		}

		echo json_encode($error);
	}

	public function displaySizeToEdit()
	{
		$error = 0;
		if(isset($_POST["dataId"]) && !empty($_POST["dataId"])){
			$dataId = $_POST["dataId"];
		}else{
			$error = 1;
		}		
		if($error == 0){
			$this->load->model("Home_Model");
			$displaySizeToEdit = $this->Home_Model->displaySizeToEdit($dataId);
		}
		
		echo json_encode($displaySizeToEdit);
	}


	public function displayColorToEdit()
	{
		$error = 0;
		if(isset($_POST["dataId"]) && !empty($_POST["dataId"])){
			$dataId = $_POST["dataId"];
		}else{
			$error = 1;
		}		
		if($error == 0){
			$this->load->model("Home_Model");
			$displayColorToEdit = $this->Home_Model->displayColorToEdit($dataId);
		}
		
		echo json_encode($displayColorToEdit);
	}


	public function submitColor()
	{	
		if(isset($_POST["addOrEditCounterInModalColor"]) && !empty($_POST["addOrEditCounterInModalColor"])){
			$addOrEditCounterInModalColor = $_POST["addOrEditCounterInModalColor"];
		}else{
			$addOrEditCounterInModalColor = "";
		}	
		if(isset($_POST["colorIdHidden"]) && !empty($_POST["colorIdHidden"])){
			$colorIdHidden = $_POST["colorIdHidden"];
		}else{
			$colorIdHidden = "";
		}	
		
		if(isset($_POST["colorNameToAddInModal"]) && !empty($_POST["colorNameToAddInModal"])){
			$colorNameToAddInModal = $_POST["colorNameToAddInModal"];
		}else{
			$colorNameToAddInModal = "";
		}	
		
		$this->load->model("Home_Model");
		if($addOrEditCounterInModalColor == 1){
			$data = $this->Home_Model->submitColorAdd($colorNameToAddInModal);
			echo json_encode($data);
		}else{
			if($colorIdHidden > 0){
				$data = $this->Home_Model->submitColorEdit($colorIdHidden, $colorNameToAddInModal);
				echo json_encode($data);
			}else{
				echo json_encode(-1);
			}
		}
	}



	public function uploadImagesInEdit(){
		$succ = 0;
		$itemId = $_POST['itemId'];
		$itemColor = $_POST['itemColor'];
		$barcode = $_POST['barcode'];
		
		$this->load->model("Home_Model");
        $curr_attached_files_count = count($_FILES);
            foreach ($_FILES as $fileindex => $files) {
                $filename = str_replace(' ', '_', $files['name']);
				$parts = explode('.', $files['name']);
                $last = array_pop($parts);
                $parts = array(implode('.', $parts), $last);
                $name = $parts[0];
                $extension = end($parts);
                $result = $this->Home_Model->uploadImagesInEdit($name,$itemId ,$extension, $itemColor, $barcode);
                $files['name'] = $result . '.' . $extension;
				$config['upload_path'] = FCPATH . "/assets/images/itemImages/";
                // $config['allowed_types'] = 'gif|jpg|jpeg|png|xlsx|docx|pdf|txt|xls';
                $config['allowed_types'] = '*';
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
	

	public function getItemImages(){
		if(isset($_POST["itemId"]) && !empty($_POST["itemId"])){
			$itemId = $_POST["itemId"];
		}else{
			$error = 1;
		}
		$this->load->model("Home_Model");
		$imagesData = $this->Home_Model->getItemImages($itemId);
		$data["imagesData"] = $imagesData;
		$drawImagesTable = $this->load->view("drawImagesTable", $data, TRUE);
		echo json_encode($drawImagesTable);
	}


	public function editItemInLogin()
	{
		$error = 0;
		if(isset($_POST["itemNameToAddToEdit"]) && !empty($_POST["itemNameToAddToEdit"])){
            $itemName = $_POST["itemNameToAddToEdit"];
        }else{
            $error = 1;
		}
		if(isset($_POST["itemDescriptionToAddToEdit"]) && !empty($_POST["itemDescriptionToAddToEdit"])){
            $itemDescription = $_POST["itemDescriptionToAddToEdit"];
        }else{
            $error = 1;
		}
		if(isset($_POST["itemBarCodeToAddToEdit"]) && !empty($_POST["itemBarCodeToAddToEdit"])){
            $itemBarCode = $_POST["itemBarCodeToAddToEdit"];
        }else{
            $error = 1;
		}
		if(isset($_POST["itemCategoryToAddToEdit"]) && !empty($_POST["itemCategoryToAddToEdit"])){
            $itemCategory = $_POST["itemCategoryToAddToEdit"];
        }else{
            $error = 6;
		}
		
		if(isset($_POST["itemPriceToAddToEdit"]) && !empty($_POST["itemPriceToAddToEdit"])){
            $itemPrice = $_POST["itemPriceToAddToEdit"];
        }else{
            $error = 5;
		}
		if(isset($_POST["itemQuantityToAddToEdit"]) && !empty($_POST["itemQuantityToAddToEdit"])){
            $itemQuantity = $_POST["itemQuantityToAddToEdit"];
        }else{
            $itemQuantity =0;
		}
		if(isset($_POST["itemSizeToAddToEdit"]) && !empty($_POST["itemSizeToAddToEdit"])){
            $itemSize = $_POST["itemSizeToAddToEdit"];
        }else{
            $error = 4;
		}
		if(isset($_POST["colorToAddToEdit"]) && !empty($_POST["colorToAddToEdit"])){
            $itemColor = $_POST["colorToAddToEdit"];
        }else{
            $error = 3;
		}
		if(isset($_POST["itemId"]) && !empty($_POST["itemId"])){
            $itemId = $_POST["itemId"];
        }else{
            $error = 1;
		}
		if(isset($_POST["saleToAddToEdit"]) && !empty($_POST["saleToAddToEdit"])){
            $saleToAddToEdit = $_POST["saleToAddToEdit"];
        }else{
            $saleToAddToEdit = 0;
		}
		if(isset($_POST["oldBarCode"]) && !empty($_POST["oldBarCode"])){
            $oldBarCode = $_POST["oldBarCode"];
        }else{
            $error = 2;
		}
		
		if(isset($_POST["matchingWithToEdit"]) && !empty($_POST["matchingWithToEdit"])){
            $matchingWithToEdit = $_POST["matchingWithToEdit"];
        }else{
            $matchingWithToEdit = "";
		}

		$this->load->model("Home_Model");
		if($error == 0){
			$transactionType = $this->Home_Model->editItemInLogin($itemId, $itemName, $itemDescription, $itemBarCode, $itemCategory, $itemPrice, $itemQuantity, $itemSize, $itemColor, $oldBarCode, $saleToAddToEdit);
		}

		echo json_encode($error);
	}


	public function deleteItemImagesInItems()
	{
		$error = 0;
		if(isset($_POST["itemImageIdToDeleteAttach"]) && !empty($_POST["itemImageIdToDeleteAttach"])){
            $itemImageIdToDeleteAttach = $_POST["itemImageIdToDeleteAttach"];
        }else{
            $error = 1;
		}
		
		$this->load->model("Home_Model");
		if($error == 0){
			$transactionType = $this->Home_Model->deleteItemImagesInItems($itemImageIdToDeleteAttach);
		}

		echo json_encode($error);
	}


	// -- -- -- -- -- -- -- -- -- -- -- //
	public function editProfile()
	{
		if(isset($_POST["firstName"]) && !empty($_POST["firstName"])){
            $firstName = $_POST["firstName"];
        }else{
            $error = 4;
		}
		if(isset($_POST["lastName"]) && !empty($_POST["lastName"])){
            $lastName = $_POST["lastName"];
        }else{
            $error = 4;
		}
		if(isset($_POST["dateOfBirth"]) && !empty($_POST["dateOfBirth"])){
            $dateOfBirth = $_POST["dateOfBirth"];
        }else{
            $error = 4;
		}
		if(isset($_POST["phoneNumber"]) && !empty($_POST["phoneNumber"])){
            $phoneNumber = $_POST["phoneNumber"];
        }else{
            $error = 4;
		}
		if(isset($_POST["description"]) && !empty($_POST["description"])){
            $description = $_POST["description"];
        }else{
            $error = 4;
		}
		$userId = $_SESSION["userId"];
		$this->load->model("Home_Model");
		$data = $this->Home_Model->editProfile($userId, $firstName, $lastName, $phoneNumber, $description);

		echo json_encode($data);
		exit();
	}

	public function getCartsData()
	{
		if(isset($_POST["selectValues"]) && !empty($_POST["selectValues"])){
			$selectValues = $_POST["selectValues"];
		}else{
			$selectValues = 1;
		}
		if(isset($_POST["fromDate"]) && !empty($_POST["fromDate"])){
			$fromDate = $_POST["fromDate"];
		}else{
			$fromDate = "";
		}
		if(isset($_POST["toDate"]) && !empty($_POST["toDate"])){
			$toDate = $_POST["toDate"];
		}else{
			$toDate = "";
		}
		$this->load->model("Home_Model");

		$cartData = $this->Home_Model->getCartsData($selectValues, $fromDate, $toDate);
		
		$data["cartData"] = $cartData;
		
		$cartTable = $this->load->view("cartsTableInLogin", $data, TRUE);

		echo json_encode($cartTable);
	}

	public function changePendingIcon()
	{
		$error = 0;
		if(isset($_POST["cartId"]) && !empty($_POST["cartId"])){
			$cartId = $_POST["cartId"];
		}else{
			$error = 1;
		}		
		if($error == 0){
			$this->load->model("Home_Model");
			$changePendingIcon = $this->Home_Model->changePendingIcon($cartId);
			
		}
		
		echo json_encode($changePendingIcon);
	}
	
	public function displayCarts()
	{
		$error = 0;
		if(isset($_POST["cartId"]) && !empty($_POST["cartId"])){
			$cartId = $_POST["cartId"];
		}else{
			$error = 1;
		}		
			
		$itemsDisplayed ="";
		if($error == 0){
			$this->load->model("Home_Model");
			$displayCarts = $this->Home_Model->displayCarts($cartId);
			$data["data"] = $displayCarts[0];
			$data["trackingNumber"] = $displayCarts[1];
			$data["replacementItems"] = $displayCarts[2];

			$itemsDisplayed = $this->load->view("drawCartInLogin", $data, TRUE);
		}
		
		echo json_encode(array($itemsDisplayed, $displayCarts[1], $displayCarts[3]));
	}
//........................Last One............................................//
}

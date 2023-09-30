<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Login_Model");
	}

	public function index()
	{
		$data["page"] = "shop";
		$data["cssLinks"] = "<link rel='stylesheet' href='".base_url()."/assets/css/home.css?ran=" . rand(1, 100000) . "' />";
		$data["scripts"] = "<script src='".base_url()."/assets/js/home.js?ran=" . rand(1, 100000) . "'></script>";
		
		$this->load->view('common/template', $data);
	}



	//..........................GET DATA SECTION....................................//
	public function categoryToDisplay()
	{
		$error = 0;
	
		if(isset($_POST["category"]) && !empty($_POST["category"])){
            $category = $_POST["category"];
        }else{
            $error = 1;
		}
		
		if($error == 0){
			$this->load->model("Home_Model");
			$itemsData = $this->Home_Model->categoryToDisplay($category);
			
			$data["itemsData"] = $itemsData;

			$itemsDisplayed = $this->load->view("displayItems", $data, TRUE);
			echo json_encode($itemsDisplayed);
		}else{

			echo json_encode($error);
		}

	}


	public function displayItemModal()
	{
		$error = 0;
		if(isset($_POST["itemId"]) && !empty($_POST["itemId"])){
            $itemId = $_POST["itemId"];
        }else{
            $itemId = -1;
		}
		if(isset($_POST["itemName"]) && !empty($_POST["itemName"])){
            $itemName = $_POST["itemName"];
        }else{
            $itemName = -1;
		}
		if(isset($_POST["productCode"]) && !empty($_POST["productCode"])){
            $productCode = $_POST["productCode"];
        }else{
            $error = 1;
		}
		
		if($error == 0){
			$this->load->model("Home_Model");
			$itemsData = $this->Home_Model->displayItemModal($itemId, $itemName, $productCode);
			$data["itemsData"] = $itemsData[0];
			$data["itemSize"] = $itemsData[1];
			$data["images"] = $itemsData[2];
			$data["itemColor"] = $itemsData[3];
			$data["currencyData"] = array(1, 'USD');

			$itemsDisplayed = $this->load->view("drawItemModal", $data, TRUE);
			
		}
		echo json_encode($itemsDisplayed);
	}



	public function displayCardigan()
	{
		$error = 0;
		if($error == 0){
			$this->load->model("Home_Model");
			$itemsData = $this->Home_Model->displayCardigan();
			
			$data["itemsData"] = $itemsData;
			$itemsDisplayed = $this->load->view("displayItemsForMainPage", $data, TRUE);
			echo json_encode($itemsDisplayed);
		}else{

			echo json_encode($error);
		}
	}
//........................Last One............................................//
}

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


//........................Last One............................................//
}

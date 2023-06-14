<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PropertyInfo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Login_Model");
		
	}

	public function index()
	{
		$data["page"] = "propertyInfo";
		$data["cssLinks"] = "<link rel='stylesheet' href='".base_url()."/assets/css/home.css?ran=" . rand(1, 10000000) . "' />";
		$data["scripts"] =  "<script src='".base_url()."/assets/js/propertyInfo.js?ran=" . rand(1, 10000000) . "'></script>";

		if(isset($_GET["propertyId"]) && !empty($_GET["propertyId"])){
			$propertyId = urldecode($_GET["propertyId"]);
		}else{
			$propertyId ="empty";
		}
		$data["propertyId"] = $propertyId;
		if($propertyId != "empty"){
			$this->load->model("Home_Model");
			$propertyFullInfo = $this->Home_Model->getPropertyFullInfo($propertyId);
			// print_r($propertyFullInfo);
			$data["propertyFullInfo"] = $propertyFullInfo;

		}
		$this->load->view('common/template', $data);
	}

	public function getAllPropertiesForSale()
	{
		$this->load->model("Home_Model");
		$getAllPropertiesForSale = $this->Home_Model->getAllPropertiesForSale();
		$data["propertyInfo"] = $getAllPropertiesForSale;
		$toDraw = $this->load->view("drawAllPropertyForSale", $data, TRUE);
		echo json_encode($toDraw);
	}

//........................Last One............................................//
}

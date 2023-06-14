<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForSale extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model("Login_Model");
	}

	public function index()
	{
		$data["page"] = "forSale";
		$data["cssLinks"] = "<link rel='stylesheet' href='".base_url()."/assets/css/home.css?ran=" . rand(1, 1000000) . "' />";
		$data["scripts"] =  "<script src='".base_url()."/assets/js/forSale.js?ran=" . rand(1, 1000000) . "'></script>";

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

	public function displayAllPins() {
		$this->load->model("Home_Model");
		$displayAllPins = $this->Home_Model->displayAllPinsForSale();
		echo json_encode($displayAllPins);
	}	

	public function getAllPropertiesForSaleInMapView()
	{
		
			$this->load->model("Home_Model");
			$getAllPropertiesForSaleInMapView = $this->Home_Model->getAllPropertiesForSale();
			$data["propertyInfo"] = $getAllPropertiesForSaleInMapView;
			$toDraw = $this->load->view("drawAllPropertyForSaleForMapView", $data, TRUE);
			echo json_encode($toDraw);
	
	}
//........................Last One............................................//
}

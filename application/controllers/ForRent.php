<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForRent extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Login_Model");
	}

	public function index()
	{
		$data["page"] = "forRent";
		$data["cssLinks"] = "<link rel='stylesheet' href='".base_url()."/assets/css/home.css?ran=" . rand(1, 1000000) . "' />";
		$data["scripts"] =  "<script src='".base_url()."/assets/js/forRent.js?ran=" . rand(1, 1000000) . "'></script>";
		$this->load->view('common/template', $data);
	}

	public function getAllPropertiesForRent(){
		$this->load->model("Home_Model");
		$getAllPropertiesForRent = $this->Home_Model->getAllPropertiesForRent();
		$data["propertyInfo"] = $getAllPropertiesForRent;
		$toDraw = $this->load->view("drawAllPropertyForSale", $data, TRUE);
		echo json_encode($toDraw);
		
	}

	public function displayAllPins() {
		$this->load->model("Home_Model");
		$displayAllPins = $this->Home_Model->displayAllPinsForRent();
		echo json_encode($displayAllPins);
	}	

	public function getAllPropertiesForRentInMapView()
	{
			$this->load->model("Home_Model");
			$getAllPropertiesForRentInMapView = $this->Home_Model->getAllPropertiesForRent();
			$data["propertyInfo"] = $getAllPropertiesForRentInMapView;
			$toDraw = $this->load->view("drawAllPropertyForSaleForMapView", $data, TRUE);
			echo json_encode($toDraw);
	
	}

//........................Last One............................................//
}

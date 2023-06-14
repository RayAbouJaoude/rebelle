<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapview extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Login_Model");
	}

	public function index() {
		$data["page"] = "mapview";
		$data["cssLinks"] = "<link rel='stylesheet' href='".base_url()."/assets/css/home.css?ran=" . rand(1, 100000000) . "' />";
		$data["scripts"] = "<script src='".base_url()."/assets/js/home.js?ran=" . rand(1, 100000000) . "'></script>";
		
		$this->load->view('common/template', $data);
	}


	public function displayAllPins() {
		$this->load->model("Home_Model");
		$displayAllPins = $this->Home_Model->displayAllPins();
		echo json_encode($displayAllPins);
	}	
//........................Last One............................................//
}

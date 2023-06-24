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


//........................Last One............................................//
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header");

$this->load->view($page);

$this->load->view("common/footer");
?>
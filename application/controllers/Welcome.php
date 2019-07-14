<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index() {
		$data = array();
		$data["page_title"] = "Home";
		$data["page"] = "home";
		$data["url"] = base_url();
		$this->load->view('view', $data);	
	}
}

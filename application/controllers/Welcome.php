<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index() {
		$data = array();
		$data["url"] = base_url();
		$isLoggedIn = $this->UtilityModel->isLoggedIn();
		if($isLoggedIn) {
			redirect($data['url']."user", "refresh");
		} else {
			$data["page_title"] = "Home";
			$data["page"] = "home";
			$this->load->view('view', $data);	
		}
	}
}

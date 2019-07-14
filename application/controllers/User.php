<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function index() {
		$data = array();
		$data["page_title"] = "LAPG - Index";
		$data["url"] = base_url();
		$isLoggedIn = $this->UtilityModel->isLoggedIn();
		if($this->input->post("login-submission") != NULL && !$isLoggedIn) {
			if($this->input->post("email") != NULL && $this->input->post("password") != NULL) {
				if($this->PaymentsModel->login($this->input->post("email"), $this->input->post("password"))) {
					redirect(base_url()."user", 'refresh'); 
				} else {
					$data["page"] = "login";
					$data["error_msg"] = "Invalid Credentials.";
					$this->load->view("view", $data);
				}
			} else {
				$data["page"] = "login";
				$data["error_msg"] = "Both E-Mail and Password are Required.";
				$this->load->view("view", $data);
			}
		} else {
			if($isLoggedIn) {
					$data["page"] = "logged_in";
					$data["user"] = $this->PaymentsModel->getUserInformation($this->session->userdata('user_id'));
					$this->load->view("view", $data);
			} else {
				$data["page"] = "login";
				$data["error_msg"] = "Fill in the Boxes Below.";
				$this->load->view("view", $data);
			}
		}
	}
	public function update($master_key = "nothing") {
		$data = array();
		$data["page_title"] = "LAPG - Update Rates";
		$data["url"] = base_url();
		if($master_key == "nothing") {
			$data["page"] = "invalid_key";
			$this->load->view("view", $data);
		} else {
			$query = $this->db->get_where("settings", array("setting_value" => $master_key));
			$result = $query->result();
			if(count($result) > 0) {
				if($this->UtilityModel->update()) {
					$data["page"] = "updated_rates";
					$this->load->view("view", $data);
				}
			} else {
				$data["page"] = "invalid_key";
				$this->load->view("view", $data);
			}
		}
	}
	public function logout() {
		$this->PaymentsModel->logout();
		redirect(base_url(), "refresh");
	}
}

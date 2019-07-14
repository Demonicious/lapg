<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function index() {
		$data = array();
		$data["page_title"] = "LAPG - Account Home";
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
				$this->load->view("view", $data);
			}
		}
	}
	public function transactions() {
		$data = array();
		$data["page_title"] = "LAPG - All Transactions";
		$data["page"] = "transactions";
		$data["url"] = base_url();
		$isLoggedIn = $this->UtilityModel->isLoggedIn();
		if($isLoggedIn) {
			$data['user'] = $this->PaymentsModel->getUserInformation($this->session->userdata('user_id'));
			$data['transactions'] = $this->PaymentsModel->getAllTransactions($this->session->userdata('user_id'));
			$this->load->view("view", $data);
		} else {
			redirect($data['url']."user", "refresh");
		}
	}
	public function change_merchant_info() {
		$data = array();
		$data["page_title"] = "LAPG - Change Merchant Info";
		$data["page"] = "change_merchant_info";
		$data["url"] = base_url();
		$isLoggedIn = $this->UtilityModel->isLoggedIn();
		if($isLoggedIn) {
			if($this->input->post("merchant-info-change-submission") != NULL) {
				if($this->input->post("merchant_name") != NULL &&  $this->input->post("merchant_description") != NULL) {
					$data["merchant_info_change"] = $this->PaymentsModel->changeMerchantInfo($this->session->userdata("user_id"), array(
						"name" => $this->input->post("merchant_name"),
						"description" => $this->input->post("merchant_description"),
					));
				} else {
					$data['merchant_info_change']["status"] = "error";
					$data['merchant_info_change']["error"] = "All Fields are Required.";
				}
			}
			$data['user'] = $this->PaymentsModel->getUserInformation($this->session->userdata("user_id"));
			$this->load->view("view", $data);
		} else {
			redirect($data['url']."user", "refresh");
		}
	}
	public function change_address() {
		$data = array();
		$data["page_title"] = "LAPG - Change Address";
		$data["page"] = "change_address";
		$data["url"] = base_url();
		$isLoggedIn = $this->UtilityModel->isLoggedIn();
		if($isLoggedIn) {
			if($this->input->post("address-change-submission") != NULL) {
				if($this->input->post("line_1") != NULL &&  $this->input->post("line_2") != NULL &&  $this->input->post("city") != NULL &&  $this->input->post("zipcode") != NULL &&  $this->input->post("state") != NULL &&  $this->input->post("country") != NULL && $this->input->post("name") != NULL) {
					$data["address_change"] = $this->PaymentsModel->changeAddress($this->session->userdata("user_id"), array(
						"name" => $this->input->post("name"),
						"line_1" => $this->input->post("line_1"),
						"line_2" => $this->input->post("line_2"),
						"city" => $this->input->post("city"),
						"zipcode" => $this->input->post("zipcode"),
						"state" => $this->input->post("state"),
						"country" => $this->input->post("country")
					));
				} else {
					$data['address_change']["status"] = "error";
					$data['address_change']["error"] = "All Fields are Required.";
				}
			}
			$data['user'] = $this->PaymentsModel->getUserInformation($this->session->userdata("user_id"));
			$this->load->view("view", $data);
		} else {
			redirect($data['url']."user", "refresh");
		}
	}
	public function change_password() {
		$data = array();
		$data["page_title"] = "LAPG - Change Password";
		$data["page"] = "change_password";
		$data["url"] = base_url();
		$isLoggedIn = $this->UtilityModel->isLoggedIn();
		if($isLoggedIn) {
			if($this->input->post("password-change-submission") != NULL) {
				if($this->input->post("new_password") != NULL &&  $this->input->post("password_confirmation") != NULL && $this->input->post("curr_password") != NULL) {
					if($this->PaymentsModel->matchPassword($this->session->userdata("user_id"), $this->input->post("curr_password"))) {
						if($this->input->post("new_password") == $this->input->post("password_confirmation")) {
							$data['password_change'] = array();
							$data["password_change"] = $this->PaymentsModel->changePassword($this->session->userdata('user_id'), $this->input->post("new_password"));
						} else {
							$data["password_change"] = array();
							$data["password_change"]["status"] = "error";
							$data["password_change"]["error"] = "Invalid Password Confirmation.";
						}
					} else {
						$data["password_change"] = array();
						$data["password_change"]["status"] = "error";
						$data["password_change"]["error"] = "Your Current Password is Invalid.";
					}
					
				} else {
					$data['password_change']["status"] = "error";
					$data['password_change']["error"] = "All Fields are Required.";
				}
			}
			$data['user'] = $this->PaymentsModel->getUserInformation($this->session->userdata("user_id"));
			$this->load->view("view", $data);
		} else {
			redirect($data['url']."user", "refresh");
		}
	}
	public function new_key() {
		$data = array();
		$data["page_title"] = "LAPG - Account Home";
		$data["page"] = "logged_in";
		$data["url"] = base_url();
		$isLoggedIn = $this->UtilityModel->isLoggedIn();
		if($isLoggedIn) {
			$this->PaymentsModel->generateNewKey($this->session->userdata('user_id'));
			redirect($data['url']."user", "refresh");
		} else {
			redirect($data['url']."user", "refresh");
		}
	}
	public function send() {
		$data = array();
		$data["page_title"] = "LAPG - Send a Payment";
		$data["page"] = "send_payment";
		$data["url"] = base_url();
		$isLoggedIn = $this->UtilityModel->isLoggedIn();
		if($isLoggedIn) {
			$sitePercentage = $this->PaymentsModel->getSetting("site_percentage");
			$data["user"] = $this->PaymentsModel->getUserInformation($this->session->userdata("user_id"));
			if($this->input->post("payment-xaddress-submission") != NULL) {
				if($this->input->post("address") != NULL) {
					if(strlen($this->input->post("address")) == 45) {
						if($this->input->post("amount") != NULL) {
							if(is_numeric($this->input->post("amount"))) {
								$curr_amount = number_format($_POST['amount'], 1);
								if(((number_format($sitePercentage, 2) / $curr_amount) / 100) <= $data["user"]["balance_held_in_currency"]) {
									$data["send_payment"] = $this->PaymentsModel->sendToXAddress($this->session->userdata("user_id"), $this->input->post("address"), $curr_amount, $data['user']['currency']);
								} else {
									$data["send_payment"] = array();
									$data["send_payment"]["status"] = "error";
									$data["send_payment"]["error"] = "Insufficient Funds.";
								}
							} else {
								$data["send_payment"] = array();
								$data["send_payment"]["status"] = "error";
								$data["send_payment"]["error"] = "Amount should be a Number";
							}
						} else {
							$data["send_payment"] = array();
							$data["send_payment"]["status"] = "error";
							$data["send_payment"]["error"] = "Amount is Required";
						}
					} else {
						$data["send_payment"] = array();
						$data["send_payment"]["status"] = "error";
						$data["send_payment"]["error"] = "Invalid XAddress Length";
					}
				} else {
					$data["send_payment"] = array();
					$data["send_payment"]["status"] = "error";
					$data["send_payment"]["error"] = "Address is Required";	
				}
			}
			$data['user'] = $this->PaymentsModel->getUserInformation($this->session->userdata("user_id"));
			$this->load->view("view", $data);
		} else {
			redirect($data['url']."user", "refresh");
		}
	}
	public function upgrade() {
		$data = array();
		$data["page_title"] = "LAPG - Upgrade To Merchant";
		$data["page"] = "merchant_upgrade";
		$data["url"] = base_url();
		$isLoggedIn = $this->UtilityModel->isLoggedIn();
		if($isLoggedIn) {
			if($this->input->post("upgrade-submission") != NULL) {
				if($this->input->post("merchant_name") != NULL &&  $this->input->post("merchant_description") != NULL) {
					$data["merchant_upgrade"] = $this->PaymentsModel->upgrade($this->session->userdata('user_id'), $this->input->post("merchant_name"), $this->input->post("merchant_description"));
				} else {
					$data['merchant_upgrade']["status"] = "error";
					$data['merchant_upgrade']["error"] = "Both Merchant Name and Merchant Description Fields are required.";
				}
			}
			$data['user'] = $this->PaymentsModel->getUserInformation($this->session->userdata("user_id"));
			$this->load->view("view", $data);
		} else {
			redirect($data['url']."user", "refresh");
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

<?php
	class PaymentsModel extends CI_Model {
		// Currency Conversion and Rates :-
		public function convert($amount, $to) {
			$query = $this->db->get_where("rates", array("currency" => $to));
			$result = $query->result();
			if(count($result) > 0) {
				$row = $result[0];
				return ($amount * $row->rate);
			} else {
				false;
			}
		}
		public function logout() {
			$this->session->unset_userdata("username");
			$this->session->unset_userdata("email");
			$this->session->unset_userdata("user_id");
			$this->session->sess_destroy();
		}
		public function login($email, $pass) {
			$query = $this->db->get_where("users", array("email" => $email), 1);
			$result = $query->result();
			if(count($result) > 0) {
				$row = $result[0];
				$login_key = md5(md5($row->salt).md5(md5($pass)).md5("3rd_degree"));
				if($login_key == $row->login_key) {
					$userdata = array(
						"username" => $row->username,
						"email" => $row->email,
						"user_id" => $row->id
					);
					$this->session->set_userdata($userdata);
					return true;
 				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		public function getAllTransactions($uid) {
			$query = $this->db->get_where("transactions", array("user_id" => $uid));
			$result = $query->result();
			$returnArray = array();
			$user = $this->getUserInformation($uid);
			foreach($result as $row) {
				$currentTransaction = array(
					"id" => $row->id,
					"user_id" => $row->user_id,
					"sent_to" => $row->sent_to,
					"amount" => $row->amount,
					"date" => date("d/M/Y", $row->timestamp),
				);
				$currentTransaction["amount_in_currency"] = $this->convert($row->amount, $user["currency"]);
				array_push($returnArray, $currentTransaction);
			}
			return $returnArray;
		}
		public function changeMerchantInfo($uid, $info) {
			$this->db->where("user_id", $uid);
			$this->db->update("merchant_info", array(
				"merchant_name" => $info["name"],
				"merchant_desc" => $info["description"],
			));
			$returnArray = array();
			$returnArray["status"] = "success";
			$returnArray["error"] = "Your Merchant Info was Successfully Changed!";
			return $returnArray;
		}
		public function changeAddress($uid, $address) {
			$this->db->where("user_id", $uid);
			$this->db->update("addresses", array(
				"address_1" => $address["line_1"],
				"address_1" => $address["line_1"],
				"zipcode" => $address["zipcode"],
				"city" => $address["city"],
				"state" => $address["state"],
				"country" => $address["country"]
			));
			$this->db->where("id", $uid);
			$this->db->update("users", array(
				"username" => $address["name"]
			));
			$returnArray = array();
			$returnArray["status"] = "success";
			$returnArray["error"] = "Your Address was Successfully Changed!";
			return $returnArray;
		}
		public function changePassword($uid, $pass) {
			$returnArray = array();
			$query = $this->db->get_where("users", array("id" => $uid));
			$result = $query->result();
			if(count($result) > 0) {
				$row = $result[0];
				$this->db->where("id", $uid);
				$this->db->update("users", array("password" => md5($pass), "login_key" => md5(md5($row->salt).md5(md5($pass)).md5("3rd_degree"))));
				$returnArray["status"] = "success";
				$returnArray["error"] = "Password Successfully Changed.";
				return $returnArray;
			} else {
				$returnArray["status"] = "error";
				$returnArray["error"] = "User ID Not Found.";
				return $returnArray;
			}
		}
		public function matchPassword($uid, $pass) {
			$query = $this->db->get_where("users", array("id" => $uid));
			$result = $query->result();
			if(count($result) > 0) {
				$row = $result[0];
				$login_key = md5(md5($row->salt).md5(md5($pass)).md5("3rd_degree"));
				if($login_key == $row->login_key) {
					return true;
				}
			} else {
				return false;
			}
		}
		public function generateNewKey($uid) {
			$query = $this->db->get_where("access_keys", array("user_id" => $uid));
			$result = $query->result();
			$newKey = $this->UtilityModel->getRandomString();
			$query = $this->db->get_where("access_keys", array("access_key" => $newKey));
			$result2 = $query->result();
			if(count($result2) == 0) {
				if(count($result) > 0) {
					$this->db->where("user_id", $uid);
					$this->db->update("access_keys", array(
						"access_key" => $this->UtilityModel->getRandomString(),
					));
					return true;
				} else {
					$this->load->model("UtilityModel");
					$this->db->insert("access_keys", array(
						"id" => NULL,
						"user_id" => $uid,
						"access_key" => $this->UtilityModel->getRandomString(),
					));
					return true;
				}
			} else {
				$this->generateNewKey($uid);
			}
		}
		public function upgrade($uid, $merchant_name, $merchant_desc) {
			$returnArray = array();
			$query = $this->db->get_where("merchant_info", array("user_id" => $uid));
			$result = $query->result();
			if(count($result) == 0) {
				if($this->db->insert("merchant_info", array("id" => NULL, "user_id" => $uid, "merchant_name" => $merchant_name, "merchant_desc" => $merchant_desc))) {
					$query = $this->db->get_where("access_keys", array("user_id" => $uid));
					$result = $query->result();
					if($this->generateNewKey($uid)) {
						$returnArray["status"] = "success";
						$returnArray["error"] = "Upgraded to Merchant.";
					} else {
						$returnArray["status"] = "error";
						$returnArray["error"] = "Could not Generate a New Access Key.";
					}
				}
			} else {
				$returnArray["status"] = "error";
				$returnArray["error"] = "Already a Merchant!";
			}
		}
		public function getUserInformation($uid) {
			$returnArray = array();
			$query = $this->db->get_where("users", array("id" => $uid));
			$result = $query->result();
			if(count($result) > 0) {
				$row = $result[0];
				$returnArray["username"] = $row->username;
				$returnArray["email"] = $row->email;
				$returnArray["unique_address"] = $row->unique_address;
				$returnArray["currency"] = $row->currency;
			}
			$query = $this->db->get_where("balance", array("user_id" => $uid));
			$result = $query->result();
			if(count($result) > 0) {
				$row = $result[0];
				$returnArray["balance_held"] = $row->balance_held;
				$returnArray["balance_held_in_currency"] = $this->convert($returnArray["balance_held"], $returnArray["currency"]);
			}
			$query = $this->db->get_where("addresses", array("user_id" => $uid));
			$result = $query->result();
			if(count($result) > 0) {
				$row = $result[0];
				$returnArray["address"] = array();
				$returnArray["address"]["line_1"] = $row->address_1;
				$returnArray["address"]["line_2"] = $row->address_2;
				$returnArray["address"]["city"] = $row->city;
				$returnArray["address"]["zipcode"] = $row->zipcode;
				$returnArray["address"]["state"] = $row->state;
				$returnArray["address"]["country"] = $row->country;
			}
			$query = $this->db->get_where("access_keys", array("user_id" => $uid));
			$result = $query->result();
			if(count($result) > 0) {
				$row = $result[0];
				$returnArray["access_key"] = $row->access_key;
			}
			$query = $this->db->get_where("transactions", array("user_id" => $uid), 5);
			$result = $query->result();
			if(count($result) > 0) {
				$returnArray["recent_transactions"] = array();
				foreach($result as $row) {
					array_push($returnArray["recent_transactions"], array(
						"id" => $row->id,
						"amount" => $row->amount,
						"amount_in_currency" => $this->convert($row->amount, $returnArray["currency"]),
						"sent_to" => $row->sent_to,
						"date" => date('d/M/Y', $row->timestamp)
					));
				}
			}
			$query = $this->db->get_where("merchant_info", array("user_id" => $uid));
			$result = $query->result();
			if(count($result) > 0) {
				$row = $result[0];
				$returnArray["merchant_info"] = array();
				$returnArray["merchant_info"]["name"] = $row->merchant_name;
				$returnArray["merchant_info"]["description"] = $row->merchant_desc;
				$returnArray["merchant_info"]["address"] = $returnArray["address"];
			}
			return $returnArray;
		}
	}
?>
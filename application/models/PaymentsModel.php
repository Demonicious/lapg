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
			$userdata = array(
				"username" => "demon",
				"email" => "demoncious@gmail.com",
				"user_id" => "1"
			);
			$this->session->set_userdata($userdata);
			return true;
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
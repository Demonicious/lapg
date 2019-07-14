<?php
	class UtilityModel extends CI_Model {
		public function isLoggedIn() {
			if($this->session->userdata('email') == NULL) {
				return false;
			} else {
				return true;
			}
		}
		public function getRandomString() {
		    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		    $pass = array(); //remember to declare $pass as an array
		    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		    for ($i = 0; $i < 20; $i++) {
		        $n = rand(0, $alphaLength);
		        $pass[] = $alphabet[$n];
		    }
		    return implode($pass); //turn the array into a string
		}
		public function update() {
			$url = 'http://data.fixer.io/api/latest';

			$apikey = '814affe4b60e3663a7b980f21ce5d416';
			$baseCurrency = "EUR";
			$format = "1";

			$ch = curl_init($url."?"."access_key=".$apikey."&base=".$baseCurrency."&format=".$format);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
			$result = json_decode(curl_exec($ch));
			curl_close($ch);

			if($result->success) {
				$rates = $result->rates;
				$batch = array();
				foreach($rates as $currency => $rate) {
					$currencyRate = array(
						"id" => NULL,
						"currency" => $currency,
						"rate" => $rate
					);
					array_push($batch, $currencyRate);
				}
				if($this->db->empty_table("rates")) {
					if($this->db->insert_batch("rates", $batch)) { return true; } else { return false; };
				} else {
					return false;
				}
				
			} else {
				return false;
			}
		}
	}
?>
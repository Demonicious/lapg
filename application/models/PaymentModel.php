<?php
	class PaymentModel extends CI_Model {

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
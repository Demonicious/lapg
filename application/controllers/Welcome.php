<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->load->model('PaymentModel');
		echo($this->PaymentModel->convert('100', 'pkr'));
		$this->load->view('welcome_message');
	}
}

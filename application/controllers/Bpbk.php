<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bpbk extends CI_Controller {

	public function index()
	{
		$this->load->view('bpbk/main');
	}

	public function dashboard()
	{
		$this->load->view('bpbk/dashboard');
	}
}

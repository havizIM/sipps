<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	public function index()
	{
		$this->load->view('guru/main');
	}

	public function dashboard()
	{
		$this->load->view('guru/dashboard');
	}
}

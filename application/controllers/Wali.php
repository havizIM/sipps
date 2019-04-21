<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali extends CI_Controller {


// Function Show
	public function index()
	{
		$this->load->view('wali/main');
	}
	public function dashboard()
	{
		$this->load->view('wali/dashboard');
	}
	public function siswa()
	{
		$this->load->view('wali/siswa');
	}

	
}

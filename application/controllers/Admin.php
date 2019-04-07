<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->load->view('admin/main2');
	}

	public function dashboard()
	{
		$this->load->view('admin/dashboard');
	}

	public function user()
	{
		$this->load->view('admin/user');
	}
}

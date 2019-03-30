<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali extends CI_Controller {

	public function index()
	{
		$this->load->view('wali/main');
	}
}

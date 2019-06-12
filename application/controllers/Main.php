<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->view('siswa/main');
	}
	public function profil()
	{
		$this->load->view('siswa/profil');
	}
	public function dashboard()
	{
		$this->load->view('siswa/dashboard');
	}
}

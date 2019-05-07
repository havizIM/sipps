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
	public function pengumuman()
	{
		$this->load->view('wali/pengumuman');
	}
	public function panggilan()
	{
		$this->load->view('wali/panggilan');
	}


	public function add_panggilan()
	{
		$this->load->view('wali/add_panggilan');
	}

	
	public function edit_panggilan($id)
	{
		$this->load->view('wali/edit_panggilan');
	}


}

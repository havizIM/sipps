<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


// Show Function
	public function index()
	{
		$this->load->view('admin/main');
	}
	public function dashboard()
	{
		$this->load->view('admin/dashboard');
	}
	public function user()
	{
		$this->load->view('admin/user');
	}
	public function m_prestasi()
	{
		$this->load->view('admin/m_prestasi');
	}
	public function m_pelanggaran()
	{
		$this->load->view('admin/m_pelanggaran');
	}
	public function kelas()
	{
		$this->load->view('admin/kelas');
	}
	public function siswa()
	{
		$this->load->view('admin/siswa');
	}

	// Function Add

	public function add_kelas()
	{
		$this->load->view('admin/add_kelas');
	}
	public function add_maspel()
	{
		$this->load->view('admin/add_maspel');
	}
	public function add_maspres()
	{
		$this->load->view('admin/add_maspres');
	}
	public function add_siswa()
	{
		$this->load->view('admin/add_siswa');
	}


// Function Edit
	public function edit_maspres($id)
	{
		$this->load->view('admin/edit_maspres');
	}
	public function edit_maspel($id)
	{
		$this->load->view('admin/edit_maspel');
	}
	public function edit_kelas($id)
	{
		$this->load->view('admin/edit_kelas');
	}
	public function edit_siswa($id)
	{
		$this->load->view('admin/edit_siswa');
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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

	public function add_maspel()
	{
		$this->load->view('admin/add_maspel');
	}

	public function add_maspres()
	{
		$this->load->view('admin/add_maspres');
	}
	public function edit_maspres()
	{
		$this->load->view('admin/edit_maspres');
	}
	public function edit_maspel()
	{
		$this->load->view('admin/edit_maspel');
	}
}

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

	public function m_prestasi()
	{
		$this->load->view('bpbk/m_prestasi');
	}

	public function m_pelanggaran()
	{
		$this->load->view('bpbk/m_pelanggaran');
	}

	public function add_maspel()
	{
		$this->load->view('bpbk/add_maspel');
	}

	public function add_maspres()
	{
		$this->load->view('bpbk/add_maspres');
	}
	public function edit_maspres()
	{
		$this->load->view('bpbk/edit_maspres');
	}
	public function edit_maspel()
	{
		$this->load->view('bpbk/edit_maspel');
	}
}

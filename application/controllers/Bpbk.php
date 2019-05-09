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
	public function siswa()
	{
		$this->load->view('bpbk/siswa');
	}
	public function pengumuman()
	{
		$this->load->view('bpbk/pengumuman');
	}
	public function panggilan()
	{
		$this->load->view('bpbk/panggilan');
	}
	public function m_prestasi()
	{
		$this->load->view('bpbk/m_prestasi');
	}
	public function m_pelanggaran()
	{
		$this->load->view('bpbk/m_pelanggaran');
	}

	// Function Add
	public function add_maspel()
	{
		$this->load->view('bpbk/add_maspel');
	}
	public function add_maspres()
	{
		$this->load->view('bpbk/add_maspres');
	}
	public function add_panggilan()
	{
		$this->load->view('bpbk/add_panggilan');
	}

	// Function Edit
	public function edit_maspres($id)
	{
		$this->load->view('bpbk/edit_maspres');
	}
	public function edit_maspel($id)
	{
		$this->load->view('bpbk/edit_maspel');
	}
	public function edit_panggilan($id)
	{
		$this->load->view('bpbk/edit_panggilan');
	}
}

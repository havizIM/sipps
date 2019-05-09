<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepsek extends CI_Controller {

	public function index()
	{
		$this->load->view('kepsek/main');
	}
	public function dashboard()
	{
		$this->load->view('kepsek/dashboard');
	}
	public function siswa()
	{
		$this->load->view('kepsek/siswa');
	}
	public function pengumuman()
	{
		$this->load->view('kepsek/pengumuman');
	}
	public function panggilan()
	{
		$this->load->view('kepsek/panggilan');
	}
	public function kelas()
	{
		$this->load->view('kepsek/kelas');
	}
	public function m_prestasi()
	{
		$this->load->view('kepsek/m_prestasi');
	}
	public function m_pelanggaran()
	{
		$this->load->view('kepsek/m_pelanggaran');
	}
}

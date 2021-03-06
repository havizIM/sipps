<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Kelas extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this->options = array(
      'cluster' => 'ap1',
      'useTLS' => true
    );

    $this->pusher = new Pusher\Pusher(
      'ced47fc67559a6b88345',
      '79da97fe54e6633c3802',
      '746694',
      $this->options
    );

		$this->load->model('KelasModel');
  }

  function show($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $id_kelas  	  = $this->input->get('kelas');
    			$wali_kelas   = $this->input->get('wali_kelas');

          $show    = $this->KelasModel->show($id_kelas, $wali_kelas);
          $kelas   = array();

          foreach($show->result() as $key){
            $json = array();

            $json['kelas']   = $key->kelas;
            $json['nip']     = $key->nip;
            $json['nama']    = $key->nama;

            $kelas[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $kelas));
        }
      }
    }
  }

  function add($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Admin'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $kelas             = $this->input->post('kelas');
            $nip               = $this->input->post('nip');

            if($kelas == '' || $nip == ''){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {

              $data = array(
                'kelas'         => $kelas,
                'wali_kelas'    => $nip
              );

              $log = array('message' => 'Berhasil menambah kelas');

              $add = $this->KelasModel->add($data);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah kelas'));
              } else {
                $this->pusher->trigger('sipps', 'kelas', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah kelas'));
              }
            }
          }
        }
      }
    }
  }

  function edit($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'POST') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Admin'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $kelas  = $this->input->get('kelas');
            $nip         = $this->input->post('nip');

            if ($kelas == null) {
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Kelas tidak ditemukan'));
            } else {
              if($nip == ''){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {

                $data = array(
                  'wali_kelas' => $nip
                );

                $log  = array('message' => 'Berhasil mengedit kelas');
                $edit = $this->KelasModel->edit($kelas, $data);

                if(!$edit){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit kelas'));
                } else {
                  $this->pusher->trigger('sipps', 'kelas', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit kelas'));
                }
              }
            }
          }
        }
      }
    }
  }

  function delete($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
			json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi = $auth->row();

          if($otorisasi->level != 'Admin'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $kelas = $this->input->get('kelas');

            if($kelas == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Kelas tidak ditemukan'));
            } else {
              $log     = array('message' => 'Berhasil menghapus kelas');
              $delete = $this->KelasModel->delete($kelas);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus kelas'));
              } else {
                $this->pusher->trigger('sipps', 'kelas', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus kelas'));
              }
            }
          }
        }
      }
    }
  }



}

?>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Maspres extends CI_Controller {

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

		$this->load->model('MaspresModel');
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

          $id_maspres  	       = $this->input->get('id_maspres');
    			$deskripsi_prestasi  = $this->input->get('deskripsi_prestasi');

          $show  = $this->MaspresModel->show($id_maspres, $deskripsi_prestasi);
          $maspres  = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_maspres']            = $key->id_maspres;
            $json['deskripsi_prestasi']    = $key->deskripsi_prestasi;
            $json['poin_prestasi']         = $key->poin_prestasi;
            $json['id_kapres']             = $key->id_kapres;
            $json['kategori_prestasi']     = $key->kategori_prestasi;
            $json['status']                = $key->status;

            $maspres[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $maspres));

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

          if($otorisasi->level != 'Admin' && $otorisasi->level != 'Bpbk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_maspres          = $this->KodeModel->buatKode('maspres', 'MPS', 'id_maspres', 3);
            $deskripsi_prestasi  = $this->input->post('deskripsi_prestasi');
            $poin_prestasi       = $this->input->post('poin_prestasi');
            $id_kapres           = $this->input->post('id_kapres');


            if($deskripsi_prestasi == '' || $poin_prestasi == null || $id_kapres == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {

              $data = array(
                'id_maspres'         => $id_maspres,
                'deskripsi_prestasi' => $deskripsi_prestasi,
                'poin_prestasi'      => $poin_prestasi,
                'kapres'             => $id_kapres,
                'status'             => 'Aktif'
              );

              $log = array('message' => 'Berhasil menambah maspres');
              $add = $this->MaspresModel->add($data);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah master prestasi'));
              } else {
                $this->pusher->trigger('sipps', 'maspres', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah master prestasi'));
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

          if($otorisasi->level != 'Admin' && $otorisasi->level != 'Bpbk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_maspres = $this->input->get('id_maspres');

            if($id_maspres == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID master prestasi tidak ditemukan'));
            } else {

              $log    = array('Berhasil menghapus maspres');
              $delete = $this->MaspresModel->delete($id_maspres);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus master prestasi'));
              } else {
                $this->pusher->trigger('sipps', 'maspres', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus master prestasi'));
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

          if($otorisasi->level != 'Admin' && $otorisasi->level != 'Bpbk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_maspres          = $this->input->get('id_maspres');
            $deskripsi_prestasi  = $this->input->post('deskripsi_prestasi');
            $poin_prestasi       = $this->input->post('poin_prestasi');
            $id_kapres           = $this->input->post('id_kapres');
            $status              = $this->input->post('status');

            if ($id_maspres == null) {
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID master prestasi tidak ditemukan'));
            } else {
              if($deskripsi_prestasi == '' || $poin_prestasi == null || $id_kapres == null || $status == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {

                $data = array(
                  'deskripsi_prestasi' => $deskripsi_prestasi,
                  'poin_prestasi'      => $poin_prestasi,
                  'kapres'             => $id_kapres,
                  'status'             => $status
                );

                $log  = array('message' => 'Berhasil mengedit maspres');
                $edit = $this->MaspresModel->edit($id_maspres, $data);

                if(!$edit){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit master prestasi'));
                } else {
                  $this->pusher->trigger('sipps', 'maspres', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit master prestasi'));
                }
              }
            }
          }
        }
      }
    }
  }
}

?>

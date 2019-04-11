<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Kapres extends CI_Controller {

  function __construct(){
    parent::__construct();

		$this->load->model('KapresModel');
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

          $id_kapres  	     = $this->input->get('id_kapres');
    			$kategori_prestasi = $this->input->get('kategori_prestasi');

          $show  = $this->KapresModel->show($id_kapres, $kategori_prestasi);
          $kapres  = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_kapres']            = $key->id_kapres;
            $json['kategori_prestasi']    = $key->kategori_prestasi;

            $kapres[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $kapres));
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
            $id_kapres         = $this->KodeModel->buatKode('kapres', 'KPS', 'id_kapres', 2);
            $kategori_prestasi = $this->input->post('kategori_prestasi');

            if($kategori_prestasi == ''){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Kategori prestasi tidak lengkap'));
            } else {

              $data = array(
                'id_kapres'         => $id_kapres,
                'kategori_prestasi' => $kategori_prestasi
              );

              $log = array('message' => 'Berhasil menambah kapres');
              $add = $this->KapresModel->add($data);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah kategori prestasi'));
              } else {
                $options = array(
                  'cluster' => 'ap1',
                  'useTLS' => true
                );
                $pusher = new Pusher\Pusher(
                  'ced47fc67559a6b88345',
                  '79da97fe54e6633c3802',
                  '746694',
                  $options
                );

                $pusher->trigger('sipps', 'kapres', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah kategori prestasi'));
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
            $id_kapres = $this->input->get('id_kapres');

            if($id_kapres == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID kategori prestasi tidak ditemukan'));
            } else {

              $log    = array('message' => 'Berhasil menghapus kapres');
              $delete = $this->KapresModel->delete($id_kapres);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus kategori prestasi'));
              } else {
                $options = array(
                  'cluster' => 'ap1',
                  'useTLS' => true
                );
                $pusher = new Pusher\Pusher(
                  'ced47fc67559a6b88345',
                  '79da97fe54e6633c3802',
                  '746694',
                  $options
                );

                $pusher->trigger('sipps', 'kapres', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus kategori prestasi'));
              }
            }
          }
        }
      }
    }
  }

}

?>

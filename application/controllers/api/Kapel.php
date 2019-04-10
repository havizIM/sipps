<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kapel extends CI_Controller {

  function __construct(){
    parent::__construct();

		$this->load->model('KapelModel');
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

          $id_kapel  	          = $this->input->get('id_kapel');
    			$kategori_pelanggaran = $this->input->get('kategori_pelanggaran');

          $show  = $this->KapelModel->show($id_kapel, $kategori_pelanggaran);
          $kapel  = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_kapel']                = $key->id_kapel;
            $json['kategori_pelanggaran']    = $key->kategori_pelanggaran;

            $kapel[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $kapel));
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

          if($otorisasi->level != 'Admin' && $otorisasi->level != 'BPBK'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_kapel             = $this->KodeModel->buatKode('kapel', 'KPL', 'id_kapel', 2);
            $kategori_pelanggaran = $this->input->post('kategori_pelanggaran');

            if($kategori_pelanggaran == ''){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Kategori pelanggaran tidak lengkap'));
            } else {

              $data = array(
                'id_kapel'             => $id_kapel,
                'kategori_pelanggaran' => $kategori_pelanggaran
              );

              $add = $this->KapelModel->add($data);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah kategori pelanggaran'));
              } else {
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah kategori pelanggaran'));
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

          if($otorisasi->level != 'Admin' && $otorisasi->level != 'BPBK'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_kapel = $this->input->get('id_kapel');

            if($id_kapel == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID kategori pelanggaran tidak ditemukan'));
            } else {
              $delete = $this->KapelModel->delete($id_kapel);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus kategori pelanggaran'));
              } else {
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus kategori pelanggaran'));
              }
            }
          }
        }
      }
    }
  }
}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maspel extends CI_Controller {

  function __construct(){
    parent::__construct();

		$this->load->model('MaspelModel');
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

          $id_maspel  	          = $this->input->get('id_maspel');
    			$deskripsi_pelanggaran  = $this->input->get('deskripsi_pelanggaran');

          $show  = $this->MaspelModel->show($id_maspel, $deskripsi_pelanggaran);
          $maspel  = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_maspel']                = $key->id_maspel;
            $json['deskripsi_pelanggaran']    = $key->deskripsi_pelanggaran;
            $json['poin_pelanggaran']         = $key->poin_pelanggaran;
            $json['id_kapel']                 = $key->id_kapel;
            $json['kategori_pelanggaran']     = $key->kategori_pelanggaran;
            $json['status']                   = $key->status;

            $maspel[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $maspel));

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
            $id_maspel              = $this->KodeModel->buatKode('maspel', 'MPL', 'id_maspel', 3);
            $deskripsi_pelanggaran  = $this->input->post('deskripsi_pelanggaran');
            $poin_pelanggaran       = $this->input->post('poin_pelanggaran');
            $id_kapel               = $this->input->post('id_kapel');


            if($deskripsi_pelanggaran == '' || $poin_pelanggaran == null || $id_kapel == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {

              $data = array(
                'id_maspel'             => $id_maspel,
                'deskripsi_pelanggaran' => $deskripsi_pelanggaran,
                'poin_pelanggaran'      => $poin_pelanggaran,
                'id_kapel'              => $id_kapel,
                'status'                => 'Aktif'
              );

              $add = $this->MaspelModel->add($data);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah master pelanggaran'));
              } else {
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah master pelanggaran'));
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

          if($otorisasi->level != 'Admin' || $otorisasi->level != 'BPBK'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_maspel = $this->input->get('id_maspel');

            if($id_maspel == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID master pelanggaran tidak ditemukan'));
            } else {
              $delete = $this->MaspelModel->delete($id_maspel);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus master pelanggaran'));
              } else {
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus master pelanggaran'));
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

          if($otorisasi->level != 'Admin' || $otorisasi->level != 'BPBK'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_maspel              = $this->input->get('id_maspel');
            $deskripsi_pelanggaran  = $this->input->post('deskripsi_pelanggaran');
            $poin_pelanggaran       = $this->input->post('poin_pelanggaran');
            $id_kapel               = $this->input->post('id_kapel');

            if ($id_maspel == null) {
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID master pelanggaran tidak ditemukan'));
            } else {
              if($deskripsi_pelanggaran == '' || $poin_pelanggaran == null || $id_kapel == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {

                $data = array(
                  'deskripsi_pelanggaran' => $deskripsi_pelanggaran,
                  'poin_pelanggaran'      => $poin_pelanggaran,
                  'kapel'                 => $id_kapel
                );

                $add = $this->MaspelModel->edit($id_maspel, $data);

                if(!$add){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit master pelanggaran'));
                } else {
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit master pelanggaran'));
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

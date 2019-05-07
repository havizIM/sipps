<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Panggilan extends CI_Controller {

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

		$this->load->model('PanggilanModel');
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

          $id_panggilan  	= $this->input->get('id_panggilan');
    			$keterangan     = $this->input->get('keterangan');

          $show        = $this->PanggilanModel->show($id_panggilan, $keterangan, $otorisasi);
          $panggilan   = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_panggilan']    = $key->id_panggilan;
            $json['keterangan']      = $key->keterangan;
            $json['file']            = $key->file;
            $json['tgl_input']       = $key->tgl_input;
            $json['nis']             = $key->nis;
            $json['nama_siswa']      = $key->nama_siswa;
            $json['kelas']           = $key->kelas;
            $json['wali_kelas']      = $key->wali_kelas;
            $json['pemberi_sanksi']  = $key->pemberi_sanksi;

            $panggilan[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $panggilan));

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

          if($otorisasi->level != 'Wali' && $otorisasi->level != 'Bpbk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {

            $id_panggilan  = $this->KodeModel->buatKode('panggilan', 'PL', 'id_panggilan', 8);
            $keterangan    = $this->input->post('keterangan');
            $nis           = $this->input->post('nis');

            if($id_panggilan == null || $keterangan == null || $nis == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {
              $file           = $this->upload_file('file', $id_panggilan);

              if($file == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'File gagal diupload'));
              } else {
                $data = array(
                  'id_panggilan'   => $id_panggilan,
                  'keterangan'     => $keterangan,
                  'nis'            => $nis,
                  'file'           => $file,
                  'user'           => $otorisasi->nip
                );


                $log = array('message' => 'Berhasil menambah panggilan');
                $add = $this->PanggilanModel->add($data);

                if(!$add){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah panggilan'));
                } else {
                  $this->pusher->trigger('sipps', 'panggilan', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah panggilan'));
                }
              }
            }
          }
        }
      }
    }
  }

  function upload_file($name, $id)
  {
    if(isset($_FILES[$name]) && $_FILES[$name]['name'] != ""){
      $files = glob('doc/panggilan/'.$id.'.*');
      foreach ($files as $key) {
        unlink($key);
      }

      $config['upload_path']   = './doc/panggilan/';
      $config['allowed_types'] = 'pdf';
      $config['overwrite']     = TRUE;
			$config['max_size']      = '3048';
			$config['remove_space']  = TRUE;
			$config['file_name']     = $id;

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if(!$this->upload->do_upload($name)){
        return null;
      } else {
        $file = $this->upload->data();
        return $file['file_name'];
      }
    } else {
      return null;
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

          if($otorisasi->level != 'Wali' && $otorisasi->level != 'Bpbk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {

            $id_panggilan  = $this->input->get('id_panggilan');
            $keterangan    = $this->input->post('keterangan');
            $nis           = $this->input->post('nis');


            if ($id_panggilan == null) {
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'ID Panggilan tidak ditemukan'));
            } else {
              if($keterangan == null || $nis == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {
                $file           = $this->upload_file('file', $nis);

                $data = array(
                  'id_panggilan'   => $id_panggilan,
                  'keterangan'     => $keterangan,
                  'nis'            => $nis,
                  'user'           => $otorisasi->nip
                );

                if($file != null){
                  $data['file'] = $file;
                }


                $log  = array('message' => 'Berhasil mengedit panggilan');
                $edit = $this->PanggilanModel->edit($id_panggilan, $data);

                if(!$edit){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit panggilan'));
                } else {
                  $this->pusher->trigger('sipps', 'panggilan', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit panggilan'));
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

          if($otorisasi->level != 'Wali' && $otorisasi->level != 'Bpbk'){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Hak akses tidak disetujui'));
          } else {
            $id_panggilan = $this->input->get('id_panggilan');

            if($id_panggilan == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'NIS tidak ditemukan'));
            } else {

              $log    = array('Berhasil menghapus panggilan');
              $delete = $this->PanggilanModel->delete($id_panggilan);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus panggilan'));
              } else {
                $files = glob('doc/panggilan/'.$id_panggilan.'.*');
                foreach ($files as $key) {
                  unlink($key);
                }

                $this->pusher->trigger('sipps', 'panggilan', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus panggilan'));
              }
            }
          }
        }
      }
    }
  }

}

?>

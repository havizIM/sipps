<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Pengumuman extends CI_Controller {

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

		$this->load->model('PengumumanModel');
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

          $id_pengumuman  	= $this->input->get('id_pengumuman');
    			$deskripsi        = $this->input->get('deskripsi');

          $show        = $this->PengumumanModel->show($id_pengumuman, $deskripsi);
          $pengumuman  = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_pengumuman']  = $key->id_pengumuman;
            $json['deskripsi']      = $key->deskripsi;
            $json['file']           = $key->file;
            $json['tgl_input']      = $key->tgl_input;
            $json['nip']            = $key->nip;
            $json['nama']           = $key->nama;

            $pengumuman[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $pengumuman));

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

            $id_pengumuman  = $this->KodeModel->buatKode('pengumuman', 'PM', 'id_pengumuman', 8);
            $deskripsi      = $this->input->post('deskripsi');

            if($id_pengumuman == null || $deskripsi == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {
              $file           = $this->upload_file('file', $id_pengumuman);

              if($file == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'File gagal diupload'));
              } else {
                $data = array(
                  'id_pengumuman'   => $id_pengumuman,
                  'deskripsi'       => $deskripsi,
                  'file'            => $file,
                  'user'            => $otorisasi->nip
                );


                $log = array('message' => 'Berhasil menambah pengumuman');
                $add = $this->PengumumanModel->add($data);

                if(!$add){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah pengumuman'));
                } else {
                  $this->pusher->trigger('sipps', 'pengumuman', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah pengumuman'));
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
      $files = glob('doc/pengumuman/'.$id.'.*');
      foreach ($files as $key) {
        unlink($key);
      }

      $config['upload_path']   = './doc/pengumuman/';
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
            $id_pengumuman = $this->input->get('id_pengumuman');

            if($id_pengumuman == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'NIS tidak ditemukan'));
            } else {

              $log    = array('message' => 'Berhasil menghapus pengumuman');
              $delete = $this->PengumumanModel->delete($id_pengumuman);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus pengumuman'));
              } else {

                $files = glob('doc/pengumuman/'.$id_pengumuman.'.*');
                foreach ($files as $key) {
                  unlink($key);
                }

                $this->pusher->trigger('sipps', 'pengumuman', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus pengumuman'));
              }
            }
          }
        }
      }
    }
  }

}

?>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class User extends CI_Controller {

  function __construct(){
    parent::__construct();

		$this->load->model('UserModel');
  }

  function show($token = null){
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
            $nip  		    = $this->input->get('nip');
      			$nama      	  = $this->input->get('nama');
            $level        = $this->input->get('level');

            $show  = $this->UserModel->show($nip, $nama, $level);
            $user  = array();

            foreach($show->result() as $key){
              $json = array();

              $json['nip']            = $key->nip;
              $json['nama']           = $key->nama;
              $json['username']       = $key->username;
              $json['password']       = $key->password;
              $json['level']          = $key->level;
              $json['tgl_registrasi'] = $key->tgl_registrasi;
              $json['foto']           = $key->foto;
              $json['status']         = $key->status;

              $user[] = $json;
            }

            json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $user));
          }
        }
      }
    }
  }

  function add($token = null){
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
            $nip        = $this->input->post('nip');
            $nama       = $this->input->post('nama');
            $username   = $this->input->post('username');
            $level      = $this->input->post('level');

            if($nip == null || $nama == null || $username == null || $level == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {

              $data = array(
                'nip'       => $nip,
                'nama'      => $nama,
                'username'  => $username,
                'password'  => substr(str_shuffle("01234567890abcdefghijklmnopqestuvwxyz"), 0, 5),
                'level'     => $level,
                'foto'      => 'user.jpg',
                'status'    => 'Aktif',
                'token'     => sha1($username)
              );

              $log = array('message' => 'Berhasil menambah user');
              $add = $this->UserModel->add($data);

              if(!$add){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah data user'));
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

                $pusher->trigger('sipps', 'user', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah data user'));
              }
            }
          }
        }
      }
    }
  }

  public function edit($token = null){
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
            $nip        = $this->input->get('nip');
            $nama       = $this->input->post('nama');
            $username   = $this->input->post('username');
            $level      = $this->input->post('level');
            $status     = $this->input->post('status');

            if($nip == null){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Tidak ada NIP User yang dipilih'));
            } else {
              if($nama == null || $username == null || $status == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {
                $data = array(
                  'nama'      => $nama,
                  'username'  => $username,
                  'level'     => $level,
                  'status'    => $status
                );

                $log  = array('message' => 'Berhasil mengedit user');
                $edit = $this->UserModel->edit($nip, $data);

                if(!$edit){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit user'));
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

                  $pusher->trigger('sipps', 'user', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit user'));
                }
              }
            }
          }
        }
      }
    }
  }

  public function delete($token = null){
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
            $nip = $this->input->get('nip');

            if($nip == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'NIP tidak ditemukan'));
            } else {

              $log    = array('message' => 'Berhasil menghapus user');
              $delete = $this->UserModel->delete($nip);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus user'));
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

                $pusher->trigger('sipps', 'user', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus user'));
              }
            }
          }
        }
      }
    }
  }

}

?>

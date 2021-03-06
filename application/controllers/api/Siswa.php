<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Siswa extends CI_Controller {

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

		$this->load->model('SiswaModel');
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

          $nis  	       = $this->input->get('nis');
    			$nama_siswa    = $this->input->get('nama_siswa');

          $show   = $this->SiswaModel->show($nis, $nama_siswa, $otorisasi);
          $siswa  = array();

          foreach($show->result() as $key){
            $json = array();

            $json['nis']                = $key->nis;
            $json['nama_siswa']         = $key->nama_siswa;
            $json['jenis_kelamin']      = $key->jenis_kelamin;
            $json['tempat_lahir']       = $key->tempat_lahir;
            $json['tgl_lahir']          = $key->tgl_lahir;
            $json['tahun_ajaran']       = $key->tahun_ajaran;
            $json['status']             = $key->status;
            $json['foto']               = $key->foto;
            $json['id_user']            = $key->id_user;
            $json['nama_wali']          = $key->nama_wali;
            $json['email']              = $key->email;
            $json['telepon']            = $key->telepon;
            $json['alamat']             = $key->alamat;
            $json['tgl_registrasi']     = $key->tgl_registrasi;
            $json['kelas']              = $key->kelas;
            $json['sum_prestasi']       = $key->sum_prestasi;
            $json['sum_pelanggaran']    = $key->sum_pelanggaran;
            $json['sisa_poin']          = 100 - $key->sum_pelanggaran + $key->sum_prestasi;

            $siswa[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $siswa));

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

            $nis            = $this->input->post('nis');
            $nama_siswa     = $this->input->post('nama_siswa');
            $jenis_kelamin  = $this->input->post('jenis_kelamin');
            $tempat_lahir   = $this->input->post('tempat_lahir');
            $tgl_lahir      = $this->input->post('tgl_lahir');
            $kelas          = $this->input->post('kelas');
            $tahun_ajaran   = $this->input->post('tahun_ajaran');
            $id_user        = $this->KodeModel->buatKode('akun_wali', 'WLM', 'id_user', 8);
            $nama_wali      = $this->input->post('nama_wali');
            $email          = $this->input->post('email');
            $telepon        = $this->input->post('telepon');
            $alamat         = $this->input->post('alamat');



            if($nis == '' || $nama_siswa == null || $jenis_kelamin == null || $tempat_lahir == null || $tgl_lahir == null || $kelas == null || $tahun_ajaran == null || $nama_wali == null || $email == null || $telepon == null || $alamat == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
            } else {
              $foto           = $this->upload_file('foto', $nis);

              if($foto == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Foto gagal diupload'));
              } else {
                $siswa = array(
                  'nis'             => $nis,
                  'nama_siswa'      => $nama_siswa,
                  'jenis_kelamin'   => $jenis_kelamin,
                  'tempat_lahir'    => $tempat_lahir,
                  'tgl_lahir'       => $tgl_lahir,
                  'kelas'           => $kelas,
                  'tahun_ajaran'    => $tahun_ajaran,
                  'foto'            => $foto,
                  'status'          => 'Aktif'
                );

                $akun = array(
                  'id_user'     => $id_user,
                  'nis'         => $nis,
                  'nama_wali'   => $nama_wali,
                  'password'    => $nis,
                  'email'       => $email,
                  'telepon'     => $telepon,
                  'alamat'      => $alamat,
                  'token'       => sha1($nama_wali)
                );

                $log = array('message' => 'Berhasil menambah siswa');
                $add = $this->SiswaModel->add($siswa, $akun);

                if(!$add){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menambah siswa'));
                } else {
                  $this->pusher->trigger('sipps', 'siswa', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menambah siswa'));
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
      $files = glob('doc/siswa/'.$id.'.*');
      foreach ($files as $key) {
        unlink($key);
      }

      $config['upload_path']   = './doc/siswa/';
      $config['allowed_types'] = 'jpg|jpeg|png';
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
            $nis = $this->input->get('nis');

            if($nis == null){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'NIS tidak ditemukan'));
            } else {

              $log    = array('Berhasil menghapus siswa');
              $delete = $this->SiswaModel->delete($nis);

              if(!$delete){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal menghapus siswa'));
              } else {

                $files = glob('doc/siswa/'.$nis.'.*');
                foreach ($files as $key) {
                  unlink($key);
                }

                $this->pusher->trigger('sipps', 'siswa', $log);
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil menghapus siswa'));
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
            $nis            = $this->input->get('nis');
            $nama_siswa     = $this->input->post('nama_siswa');
            $jenis_kelamin  = $this->input->post('jenis_kelamin');
            $tempat_lahir   = $this->input->post('tempat_lahir');
            $tgl_lahir      = $this->input->post('tgl_lahir');
            $kelas          = $this->input->post('kelas');
            $tahun_ajaran   = $this->input->post('tahun_ajaran');
            $nama_wali      = $this->input->post('nama_wali');
            $email          = $this->input->post('email');
            $telepon        = $this->input->post('telepon');
            $alamat         = $this->input->post('alamat');
            $status         = $this->input->post('status');


            if ($nis == null) {
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'NIS tidak ditemukan'));
            } else {
              if($nama_siswa == null || $jenis_kelamin == null || $tempat_lahir == null || $tgl_lahir == null || $kelas == null || $tahun_ajaran == null || $nama_wali == null || $email == null || $telepon == null || $alamat == null || $status == null){
                json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
              } else {
                $foto           = $this->upload_file('foto', $nis);

                $siswa = array(
                  'nama_siswa'      => $nama_siswa,
                  'jenis_kelamin'   => $jenis_kelamin,
                  'tempat_lahir'    => $tempat_lahir,
                  'tgl_lahir'       => $tgl_lahir,
                  'kelas'           => $kelas,
                  'tahun_ajaran'    => $tahun_ajaran,
                  'status'          => $status
                );

                if($foto != null){
                  $siswa['foto'] = $foto;
                }

                $akun = array(
                  'nama_wali'   => $nama_wali,
                  'email'       => $email,
                  'telepon'     => $telepon,
                  'alamat'      => $alamat
                );


                $log  = array('message' => 'Berhasil mengedit siswa');
                $edit = $this->SiswaModel->edit($nis, $siswa, $akun);

                if(!$edit){
                  json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal mengedit siswa'));
                } else {
                  $this->pusher->trigger('sipps', 'siswa', $log);
                  json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengedit siswa'));
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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  function __construct()
  {
    parent::__construct();

		$this->load->model('AuthModel');
  }

  function login_user()
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {

      $nip      = $this->input->post('nip');
      $password = $this->input->post('password');

      if($nip == null || $password == null) {
        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'NIP/Username dan Password belum lengkap' ));
      } else {
        $user   = $this->AuthModel->loginUser($nip);

        if($user->num_rows() == 0){
          json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'NIP/Username tidak ditemukan' ));
        } else {
          foreach($user->result() as $key){
            $db_password    = $key->password;
            $status         = $key->status;
            $level          = $key->level;

            $session = array(
              'nip'            => $key->nip,
              'nama'           => $key->nama,
              'username'       => $key->username,
              'tgl_registrasi' => $key->tgl_registrasi,
              'foto'           => $key->foto,
              'level'          => strtolower($key->level),
              'token'          => $key->token
            );

          }

          if(hash_equals($password, $db_password)){
            if($status != 'Aktif'){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'User sudah tidak aktif' ));
            } else {
              json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan login', 'data' => $session ));
            }
          } else {
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Password salah' ));
          }
        }
      }
    }
  }

  function logout_user($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil logout'));
        }
      }
    }
  }

  function password_user($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $auth = $this->AuthModel->cekAuth($token);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $db_password  = $otorisasi->password;
          $old_password = $this->input->post('password_lama');
          $new_password = $this->input->post('password_baru');

          if($old_password == null || $new_password == null){
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
          } else {
            if($old_password != $db_password){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Password lama salah'));
            } else {

              $data = array(
                'password' => $new_password
              );

              $pass = $this->AuthModel->gantiPass($otorisasi->nip, $data);

              if(!$pass){
                json_output(500, array('status' => 500, 'description' => 'Gagal', 'message' => 'Gagal mengganti password'));
              } else {
                json_output(200, array('status' => 200, 'description' => 'Gagal', 'message' => 'Berhasil mengganti password'));
              }
            }
          }
        }
      }
    }
  }

  function foto_user($token = null)
  {

  }

  function login_wali(){
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {

      $nis      = $this->input->post('nis');
      $password = $this->input->post('password');

      if($nis == null || $password == null) {
        json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'NIS dan Password belum lengkap' ));
      } else {
        $param    = array('a.nis' => $nis);
        $wali = $this->AuthModel->cekAuthWali($param);

        if($wali->num_rows() == 0){
          json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'NIS tidak ditemukan' ));
        } else {
          foreach($wali->result() as $key){
            $db_password    = $key->password;
            $status         = $key->status;

            $session = array(
              'id_user'       => $key->id_user,
              'nis'           => $key->nis,
              'nama_siswa'    => $key->nama_siswa,
              'nama_wali'     => $key->nama_wali,
              'token'         => $key->token
            );
          }

          if(hash_equals($password, $db_password)){
            if($status != 'Aktif'){
              json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Akun ini sudah tidak aktif' ));
            } else {
              json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan login', 'data' => $session ));
            }
          } else {
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Password salah' ));
          }
        }
      }
    }
  }

  function lupa_password(){
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      $email 				= $this->input->post('email');
			$new_password = substr(str_shuffle("01234567890abcdefghijklmnopqestuvwxyz"), 0, 5);

      if($email == null){
        json_output(400, array('status' => 400, 'description' => 'Failed', 'message' => 'Email tidak boleh kosong' ));
      } else {
        $param    = array('email' => $email);
        $wali     = $this->AuthModel->cekAuthWali($param);

        if($wali->num_rows() != 1){
  				json_output(400, array('status' => 400, 'description' => 'Failed', 'message' => 'Email tidak ditemukan' ));
  			} else {

          $this->load->library('email');
          $otorisasi = $wali->row();

          $data_email = array(
            'nama_wali'     => $otorisasi->nama_wali,
            'password'      => $new_password
          );

          $template = $this->load->view('email/lupa_password', $data_email, true);

          $config = array(
            'charset'   => 'utf-8',
            'wordwrap'  => TRUE,
            'mailtype'  => 'html',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'adm.alhuda01@gmail.com',
            'smtp_pass' => 'cintaku1',
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
          );

          $this->email->initialize($config);
          $this->email->from('adm.alhuda01@gmail.com', 'Admin SIPPS');
          $this->email->to($email);
          $this->email->subject('Reset Password Akun SIPPS');
          $this->email->message($template);

          $send = $this->email->send();

          if (!$send) {
            json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Tidak dapat mengirim email'));
          } else {
            $data = array(
              'password' => $new_password
            );

            $update = $this->AuthModel->updateWali($param, $data);

            if(!$update){
							json_output(400, array('status' => 400, 'description' => 'Gagal', 'message' => 'Gagal melakukan reset password' ));
						} else {
							json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan reset password. Silahkan cek email anda untuk mendapatkan password baru'));
						}
          }
        }
      }
    }
  }

  function password_wali($token = null)
  {
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'POST') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthWali($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {
          $otorisasi = $auth->row();

          $db_password  = $otorisasi->password;
          $old_password = $this->input->post('password_lama');
          $new_password = $this->input->post('password_baru');

          if($old_password == null || $new_password == null){
            json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Data yang dikirim tidak lengkap'));
          } else {
            if($old_password != $db_password){
              json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Password lama salah'));
            } else {

              $data = array(
                'password' => $new_password
              );

              $update = $this->AuthModel->updateWali($param, $data);

              if(!$update){
                json_output(500, array('status' => 500, 'description' => 'Gagal', 'message' => 'Gagal mengganti password'));
              } else {
                json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil mengganti password'));
              }
            }
          }
        }
      }
    }
  }

  function logout_wali($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      $param  = array('token' => $token);
      $auth   = $this->AuthModel->cekAuthWali($param);

      if($auth->num_rows() != 1){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
      } else {
        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan logout'));
      }
    }
  }

  function profile_wali($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah' ));
    } else {
      $param  = array('token' => $token);
      $auth   = $this->AuthModel->cekAuthWali($param);

      if($auth->num_rows() != 1){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
      } else {
        $profile  = array();

        foreach($auth->result() as $key){
          $json = array();

          $json['id_user']        = $key->id_user;
          $json['nama_wali']      = $key->nama_wali;
          $json['email']          = $key->email;
          $json['telepon']        = $key->telepon;
          $json['alamat']         = $key->alamat;
          $json['tgl_registrasi'] = $key->tgl_registrasi;
          $json['nis']            = $key->nis;
          $json['nama_siswa']     = $key->nama_siswa;
          $json['jenis_kelamin']  = $key->jenis_kelamin;
          $json['tempat_lahir']   = $key->tempat_lahir;
          $json['tgl_lahir']      = $key->tgl_lahir;
          $json['kelas']          = $key->kelas;
          $json['tahun_ajaran']   = $key->tahun_ajaran;
          $json['foto']           = $key->foto;

          $profile[] = $json;
        }
        json_output(200, array('status' => 200, 'description' => 'Berhasil', 'message' => 'Berhasil melakukan logout', 'data' => $profile));
      }
    }
  }

}

 ?>

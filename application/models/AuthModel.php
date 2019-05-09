<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    function loginUser($param)
    {
      return $this->db->select('*')->from('user')->where('nip', $param)->or_where('username', $param)->get();
    }

    function cekAuth($token)
    {
      return $this->db->select('nip, username, level, password')->from('user')->where('token', $token)->get();
    }

    function gantiPass($param, $data)
    {
      return $this->db->where('nip', $param)->update('user', $data);
    }

    function cekAuthWali($param)
    {
      return $this->db->select('*')->from('akun_wali a')->join('siswa b', 'b.nis = a.nis')->where($param)->get();
    }

    function updateWali($param, $data)
    {
      return $this->db->where($param)->update('akun_wali', $data);
    }

}

?>

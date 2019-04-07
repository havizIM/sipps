<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    function show($nip = null, $nama = null, $level = null)
    {
      $this->db->select('*')->from('user');

      if($nip != null){
        $this->db->where('nip', $nip);
      }

      if($level != null){
        $this->db->where('level', $level);
      }

      if($nama != null){
        $this->db->like('nama', $nama);
      }

      $this->db->where('level !=', 'Admin');
      $this->db->order_by('tgl_registrasi', 'desc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('user', $data);
    }

    function edit($param, $data)
    {
      $this->db->where('nip', $param);
      return $this->db->update('user', $data);
    }

    function delete($param)
    {
      $this->db->where('nip', $param);
      return $this->db->delete('user');
    }
}

?>

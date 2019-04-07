<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KelasModel extends CI_Model {

    function show($kelas = null, $wali_kelas = null)
    {
      $this->db->select('*')->from('kelas a');
      $this->db->join('user b', 'b.nip = a.wali_kelas');

      if($kelas != null){
        $this->db->where('a.kelas', $kelas);
      }

      if($wali_kelas != null){
        $this->db->like('b.nama', $wali_kelas);
      }

      $this->db->order_by('kelas', 'asc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('kelas', $data);
    }

    function delete($param)
    {
      $this->db->where('kelas', $param);
      return $this->db->delete('kelas');
    }

}

?>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KapresModel extends CI_Model {

    function show($id_kapres = null, $kategori_prestasi = null)
    {
      $this->db->select('*')->from('kapres');

      if($id_kapres != null){
        $this->db->where('id_kapres', $id_kapres);
      }

      if($kategori_prestasi != null){
        $this->db->like('kategori_prestasi', $kategori_prestasi);
      }

      $this->db->order_by('id_kapres', 'asc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('kapres', $data);
    }

    function delete($param)
    {
      $this->db->where('id_kapres', $param);
      return $this->db->delete('kapres');
    }

}

?>

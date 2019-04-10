<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MaspresModel extends CI_Model {

    function show($id_maspres = null, $deskripsi_prestasi = null)
    {
      $this->db->select('*')->from('maspres a')->join('kapres b', 'b.id_kapres = a.kapres', 'left');

      if($id_maspres != null){
        $this->db->where('a.id_maspres', $id_maspres);
      }

      if($deskripsi_prestasi != null){
        $this->db->like('a.deskripsi_prestasi', $deskripsi_prestasi);
      }

      $this->db->order_by('a.id_maspres', 'desc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('maspres', $data);
    }

    function delete($param)
    {
      $this->db->where('id_maspres', $param);
      return $this->db->delete('maspres');
    }

    function edit($param, $data)
    {
      $this->db->where('id_maspres', $param);
      return $this->db->update('maspres', $data);
    }

}

?>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MaspelModel extends CI_Model {

    function show($id_maspel = null, $deskripsi_pelanggaran = null)
    {
      $this->db->select('*')->from('maspel a')->join('kapel b', 'b.id_kapel = a.kapel', 'left');

      if($id_maspel != null){
        $this->db->where('a.id_maspel', $id_maspel);
      }

      if($deskripsi_pelanggaran != null){
        $this->db->like('a.deskripsi_pelanggaran', $deskripsi_pelanggaran);
      }

      $this->db->order_by('a.id_maspel', 'desc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('maspel', $data);
    }

    function delete($param)
    {
      $this->db->where('id_maspel', $param);
      return $this->db->delete('maspel');
    }

    function update($param, $data)
    {
      $this->db->where('id_maspel', $param);
      return $this->db->delete('maspel', $data);
    }

}

?>

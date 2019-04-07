<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KapelModel extends CI_Model {

    function show($id_kapel = null, $kategori_pelanggaran = null)
    {
      $this->db->select('*')->from('kapel');

      if($id_kapel != null){
        $this->db->where('id_kapel', $id_kapel);
      }

      if($kategori_pelanggaran != null){
        $this->db->like('kategori_pelanggaran', $kategori_pelanggaran);
      }

      $this->db->order_by('id_kapel', 'desc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('kapel', $data);
    }

    function delete($param)
    {
      $this->db->where('id_kapel', $param);
      return $this->db->delete('kapel');
    }

}

?>

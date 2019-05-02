<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PengumumanModel extends CI_Model {

    function show($id_pengumuman = null, $deskripsi = null)
    {
      $this->db->select('a.*, b.nip, b.nama')->from('pengumuman a')->join('user b', 'b.nip = a.user', 'left');

      if($id_pengumuman != null){
        $this->db->where('a.id_pengumuman', $id_pengumuman);
      }

      if($deskripsi != null){
        $this->db->like('a.deskripsi', $deskripsi);
      }

      $this->db->order_by('a.id_pengumuman', 'desc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('pengumuman', $data);
    }

    function delete($param)
    {
      $this->db->where('id_pengumuman', $param);
      return $this->db->delete('pengumuman');
    }

}

?>

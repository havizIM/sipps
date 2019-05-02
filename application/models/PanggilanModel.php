<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PanggilanModel extends CI_Model {

    function show($id_panggilan = null, $keterangan = null, $otorisasi)
    {
      $this->db->select('a.*, b.nis, b.nama_siswa, c.kelas, d.nama as wali_kelas, e.nama as pemberi_sanksi')
              ->from('panggilan a')
              ->join('siswa b', 'b.nis = a.nis')
              ->join('kelas c', 'c.kelas = b.kelas')
              ->join('user d', 'd.nip = c.wali_kelas')
              ->join('user e', 'e.nip = a.user');

      if($id_panggilan != null){
        $this->db->where('a.id_panggilan', $id_panggilan);
      }

      if($keterangan != null){
        $this->db->like('a.keterangan', $keterangan);
      }

      if($otorisasi->level == 'Wali'){
        $this->db->where('d.nip', $otorisasi->nip);
        $this->db->where('b.status', 'Aktif');
      }

      $this->db->order_by('a.id_panggilan', 'desc');
      return $this->db->get();
    }

    function add($data)
    {
      return $this->db->insert('panggilan', $data);
    }

    function delete($param)
    {
      $this->db->where('id_panggilan', $param);
      return $this->db->delete('panggilan');
    }

    function edit($param, $data)
    {
      $this->db->where('id_panggilan', $param);
      return $this->db->update('panggilan', $data);
    }

}

?>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SiswaModel extends CI_Model {

    function show($nis = null, $nama_siswa = null, $otorisasi)
    {
      $this->db->select('a.*, b.*, c.*, d.nip')
               ->from('siswa a')
               ->join('akun_wali b', 'b.nis = a.nis')
               ->join('kelas c', 'c.kelas = a.kelas')
               ->join('user d', 'd.nip = c.wali_kelas');

      if($nis != null){
        $this->db->where('a.nis', $nis);
      }

      if($nama_siswa != null){
        $this->db->like('a.nama_siswa', $nama_siswa);
      }

      if($otorisasi->level == 'Wali'){
        $this->db->where('d.nip', $otorisasi->nip);
      }

      $this->db->order_by('a.nis', 'desc');
      return $this->db->get();
    }

    function add($siswa, $akun)
    {
      $this->db->trans_start();
      $this->db->insert('siswa', $siswa);
      $this->db->insert('akun_wali', $akun);
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

    function delete($param)
    {
      $this->db->where('nis', $param);
      return $this->db->delete('siswa');
    }

    function edit($nis, $siswa, $akun)
    {
      $this->db->trans_start();
      $this->db->where('nis', $nis)->update('akun_wali', $akun);
      $this->db->where('nis', $nis)->update('siswa', $siswa);
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

}

?>

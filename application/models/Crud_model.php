<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model{

    function display()
    {
      $query = $this->db->query("SELECT * FROM profile");
      return $query->result();
    }
    function insert($nama, $notlp, $alamat)
    {
      $query = $this->db->query("INSERT INTO profile (nama, notelp, alamat ) VALUES ('$nama', '$notlp','$alamat') ");
      return $query;
    }
    function update($nama, $notlp, $alamat, $id)
    {
      $query = $this->db->query("UPDATE profile SET nama='$nama',notelp='$notlp',alamat='$alamat' WHERE id='$id'");
      return $query;
    }
    function delete($id)
    {
      $query = $this->db->query("DELETE FROM profile WHERE id='$id'");
      return $query;
    }
}

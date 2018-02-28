<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('crud_model');
    //Codeigniter : Write Less Do More
  }
  function index()
  {
    $this->load->view('v_crud');
  }
  function data_biodata()
  {
    $data = $this->crud_model->display();
    echo json_encode($data);
  }
  function aksi()
  {
    $info = json_decode(file_get_contents("php://input") );
    if(count($info)>0){
      $id       = $info->id;
      $nama     = $info->nama;
      $notlp    = $info->notelp;
      $alamat   = $info->alamat;
      $btn_name = $info->btnName;
      if($btn_name == "Insert"){
        $query = $this->crud_model->insert($nama, $notlp, $alamat);
        if($query){
          echo "berhasil";
          //echo $this->session->set_flashdata('msg', 'Berhasil Menympan data');
        }else{
          echo $this->session->set_flashdata('msg', 'Gagal Menympan Data');
        }
      }
    }
    if($btn_name == "Update"){
      $query  = $this->crud_model->update($nama, $notlp, $alamat, $id);
        if($query){
          echo "berhasil";
        }else{
          echo "gagal";
        }
    }
  }
  function delete()
  {
    $info = json_decode(file_get_contents("php://input") );
    if(count($info)>0){
      $id = $info->id;
      $query = $this->crud_model->delete($id);
    }
  }

}

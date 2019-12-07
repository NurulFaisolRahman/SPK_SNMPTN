<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

  public function index(){
    $this->load->database();
		$Data['Prodi'] = $this->db->get('Prodi')->result_array();
		$this->load->view('Daftar',$Data);
	}

  public function CekDaftar(){
  	$username = $_POST['Username'];
  	$password = $_POST['Password'];
    $minat = $_POST['IdProdi'];
    $tahun = $_POST['Tahun'];
		$this->load->database();
    $this->db->insert('Akun', array('Username' => $username, 'Password' => $password));
    $this->db->insert('DataSiswa', array('NomorPendaftaran' => $username, 'IdProdi' => $minat, 'Tahun' => $tahun));
    $DataSession = array('Status' => "Login", 'User' => $username);
		$this->session->set_userdata($DataSession);
    echo 'ok';
	}

}

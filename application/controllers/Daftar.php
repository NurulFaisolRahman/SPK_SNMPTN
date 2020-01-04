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
    $TanggalLahir = $_POST['TanggalLahir'];
    $JenisKelamin = $_POST['JenisKelamin'];
    $minat = $_POST['IdProdi'];
    $tahun = $_POST['Tahun'];
    $nomor = password_hash("spk", PASSWORD_DEFAULT);
		$this->load->database();
    $this->db->insert('Akun', array('Username' => substr($nomor, 7, 20), 'Password' => $password));
    $this->db->insert('Nilai', array('NomorPendaftaran' => substr($nomor, 7, 20)));
    $this->db->insert('DataSiswa', array('NomorPendaftaran' => substr($nomor, 7, 20), 'IdProdi' => $minat, 'NamaSiswa' => $username, 'TanggalLahir' => $TanggalLahir, 'JenisKelamin' => $JenisKelamin, 'Tahun' => $tahun));
    $DataSession = array('Status' => "Login", 'User' => substr($nomor, 7, 20));
		$this->session->set_userdata($DataSession);
    echo 'ok';
	}

}

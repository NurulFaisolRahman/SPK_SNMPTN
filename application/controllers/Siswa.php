<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

  function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login"){
			redirect(base_url());
		}
	}

  public function index(){
    $this->load->database();
		$query = "SELECT DataSiswa.NomorPendaftaran,DataSiswa.NPSNSekolah,DataSiswa.NamaSiswa,DataSiswa.JenisKelamin,DataSiswa.TanggalLahir,DataSiswa.Rangking,Prodi.NamaProdi FROM Prodi,DataSiswa WHERE Prodi.IdProdi=DataSiswa.IdProdi AND DataSiswa.NomorPendaftaran="."'".$this->session->userdata('User')."'";
	  $Data['Siswa'] = $this->db->query($query)->result_array();
		$Data['Prodi'] = $this->db->get('Prodi')->result_array();
		$query = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME = 'DataSiswa'";
	  $Data['FormSiswa'] = $this->db->query($query)->result_array();
		$this->load->view('HeaderSiswa');
	  $this->load->view('HalamanSiswa',$Data);
	  $this->load->view('FooterSiswa');
	}

  public function UpdateSiswa(){
	$this->load->database();
  	$this->db->where('NomorPendaftaran', $_POST['NomorPendaftaran']);
	array_shift($_POST);
  	$this->db->update('DataSiswa', $_POST);
	redirect(base_url('Siswa'));
  }

  public function UpdateNilai(){
	$this->load->database();
  	$this->db->where('NomorPendaftaran', $_POST['NomorPendaftaran']);
	array_shift($_POST);
  	$this->db->update('Nilai', $_POST);
  	$IND = ($_POST['IND1'] + $_POST['IND2'] + $_POST['IND3'] + $_POST['IND4'] + $_POST['IND5']) / 5;
  	$ING = ($_POST['ING1'] + $_POST['ING2'] + $_POST['ING3'] + $_POST['ING4'] + $_POST['ING5']) / 5;
  	$MAT = ($_POST['MAT1'] + $_POST['MAT2'] + $_POST['MAT3'] + $_POST['MAT4'] + $_POST['MAT5']) / 5;
  	$BIO = ($_POST['BIO1'] + $_POST['BIO2'] + $_POST['BIO3'] + $_POST['BIO4'] + $_POST['BIO5']) / 5;
  	$FIS = ($_POST['FIS1'] + $_POST['FIS2'] + $_POST['FIS3'] + $_POST['FIS4'] + $_POST['FIS5']) / 5;
  	$KIM = ($_POST['KIM1'] + $_POST['KIM2'] + $_POST['KIM3'] + $_POST['KIM4'] + $_POST['KIM5']) / 5;
  	$Rata2 = array('IND' => $IND,'ING' => $ING,'MAT' => $MAT,'KIM' => $KIM,'FIS' => $FIS,'KIM' => $KIM);
  	$this->db->update('DataSiswa', $Rata2);
	redirect(base_url('Siswa/Nilai'));
  }

  public function Nilai(){
	$this->load->database();
  	$Data['Nilai'] = $this->db->get_where('Nilai', array('NomorPendaftaran' => $this->session->userdata('User')))->result_array()[0];
	$this->load->view('HeaderSiswa');
  	$this->load->view('NilaiSemester',$Data);
  	$this->load->view('FooterSiswa');
  }
}

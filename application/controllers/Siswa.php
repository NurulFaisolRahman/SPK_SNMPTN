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
		$query = "SELECT DataSiswa.NomorPendaftaran,DataSiswa.NPSNSekolah,Prodi.NamaProdi FROM Prodi,DataSiswa WHERE Prodi.IdProdi=DataSiswa.IdProdi AND DataSiswa.NomorPendaftaran="."'".$this->session->userdata('User')."'";
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
	  $this->db->where('NomorPendaftaran', $_POST['NomorPendaftaranLama']);
		array_shift($_POST);
	  $this->db->update('DataSiswa', $_POST);
		redirect(base_url('Siswa'));
	}
}

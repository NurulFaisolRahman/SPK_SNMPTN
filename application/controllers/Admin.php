<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login" || $this->session->userdata('User') != "admin"){
			redirect(base_url());
		}
	}

	public function Prodi(){
		$this->load->database();
		$Data['Prodi'] = $this->db->get('Prodi')->result_array();
		$this->load->view('Header');
		$this->load->view('Prodi',$Data);
		$this->load->view('Footer');
	}

	public function UpdateProdi(){
		$this->load->database();
		$this->db->where('IdProdi', $_POST['EditIdProdi']);
		$this->db->update('Prodi', array('NamaProdi' => $_POST['EditNamaProdi']));
		echo 'ok';
	}

	public function TambahProdi(){
		$this->load->database();
		$this->db->insert('Prodi', array('NamaProdi' => $_POST['NamaProdiBaru']));
		echo 'ok';
	}

	public function HapusProdi(){
		$this->load->database();
		$this->db->delete('Prodi', array('IdProdi' => $_POST['HapusIdProdi']));
		$this->db->delete('DataSiswa', array('IdProdi' => $_POST['HapusIdProdi']));
		echo 'ok';
	}

	public function Kriteria(){
		$this->load->database();
		$Data['Kriteria'] = $this->db->get('Kriteria')->result_array();
		$this->load->view('Header');
		$this->load->view('Kriteria',$Data);
		$this->load->view('Footer');
	}

	public function Siswa(){
	  $this->load->database();
		$query = "SELECT DataSiswa.NomorPendaftaran,DataSiswa.NPSNSekolah,DataSiswa.NamaSiswa,DataSiswa.JenisKelamin,DataSiswa.TanggalLahir,DataSiswa.Rangking,Prodi.NamaProdi FROM Prodi,DataSiswa WHERE Prodi.IdProdi=DataSiswa.IdProdi";
	  $Data['Siswa'] = $this->db->query($query)->result_array();
		$Data['Prodi'] = $this->db->get('Prodi')->result_array();
		$query = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME = 'DataSiswa'";
	  $Data['FormSiswa'] = $this->db->query($query)->result_array();
		$this->load->view('Header');
	  $this->load->view('Siswa',$Data);
	  $this->load->view('Footer');
	}

	public function TambahSiswa(){
	  $this->load->database();
		$this->db->insert('DataSiswa', $_POST);
		redirect(base_url('Admin/Siswa'));
	}

	public function UpdateSiswa(){
		$this->load->database();
	  $this->db->where('NomorPendaftaran', $_POST['NomorPendaftaranLama']);
		array_shift($_POST);
	  $this->db->update('DataSiswa', $_POST);
		redirect(base_url('Admin/Siswa'));
	}

	public function HapusSiswa(){
	  $this->load->database();
	  $this->db->delete('DataSiswa', array('NomorPendaftaran' => $_POST['HapusSiswa']));
	  echo 'ok';
	}

	public function Perhitungan(){
		$this->load->database();
		$query = "SELECT Prodi.IdProdi,Prodi.NamaProdi FROM Prodi WHERE Prodi.IdProdi IN (SELECT DataSiswa.IdProdi FROM DataSiswa)";
		$Data['Prodi'] = $this->db->query($query)->result_array();
		$query = "SELECT DISTINCT Tahun,IdProdi FROM DataSiswa";
		$Data['FilterData'] = $this->db->query($query)->result_array();
		$Data['Kriteria'] = $this->db->get('Kriteria')->result_array();
		$Data['Bobot'] = $this->db->get('Bobot')->result_array();
		$Data['TotalKriteria'] = $this->db->get('Kriteria')->num_rows();
		$query = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME = 'DataSiswa'";
	  	$Data['FormSiswa'] = $this->db->query($query)->result_array();
		$this->load->view('Header');
	  	$this->load->view('Perhitungan',$Data);
	  	$this->load->view('Footer');
	}

	public function SimpanBobot(){
		$this->load->database();
		$this->db->insert('Bobot', array('Bobot' => $_POST['BOBOT']));
	}

}

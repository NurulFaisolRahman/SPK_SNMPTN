<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login" || $this->session->userdata('User') != "admin"){
			redirect(base_url());
		}
	}

	public function index(){
		// $this->load->view('Login');
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

	public function TambahKriteria(){
		$this->load->database();
		$NamaKriteria = $_POST['NamaKriteriaBaru'];
		$this->db->insert('Kriteria', array('NamaKriteria' => $NamaKriteria));
		$query = "ALTER TABLE DataSiswa ADD COLUMN $NamaKriteria Varchar(30)";
	  $this->db->query($query);
		echo 'ok';
	}

	public function UpdateKriteria(){
	  $this->load->database();
	  $this->db->where('IdKriteria', $_POST['EditIdKriteria']);
	  $this->db->update('Kriteria', array('NamaKriteria' => $_POST['EditNamaKriteria']));
	  // $NamaKriteria = $_POST['EditNamaKriteria'];
	  // $NamaKriteriaLama = $_POST['NamaKriteriaLama'];
	  // $query = "ALTER TABLE DataSiswa CHANGE IF EXISTS $NamaKriteriaLama $NamaKriteria Varchar(30)";
	  // $this->db->query($query);
	  echo 'ok';
	}

	public function HapusKriteria(){
	  $this->load->database();
		$NamaKriteria = $_POST['HapusNamaKriteria'];
		$query = "ALTER TABLE DataSiswa DROP COLUMN IF EXISTS $NamaKriteria";
	  $this->db->query($query);
		$Data = $this->db->get_where('SubKriteria', array('IdKriteria' => $_POST['HapusIdKriteria']))->result_array();
		foreach ($Data as $key) {
			$NamaSubKriteria = $key['NamaSubKriteria'];
			$query = "ALTER TABLE DataSiswa DROP COLUMN IF EXISTS $NamaSubKriteria";
		  $this->db->query($query);
		}
	  $this->db->delete('Kriteria', array('IdKriteria' => $_POST['HapusIdKriteria']));
		$this->db->delete('SubKriteria', array('IdKriteria' => $_POST['HapusIdKriteria']));

		echo 'ok';
	}

	public function SubKriteria(){
	  $this->load->database();
		$query = "SELECT Kriteria.NamaKriteria,SubKriteria.IdKriteria,SubKriteria.IdSubKriteria,SubKriteria.NamaSubKriteria FROM Kriteria,SubKriteria WHERE Kriteria.IdKriteria = SubKriteria.IdKriteria";
	  $Data['SubKriteria'] = $this->db->query($query)->result_array();
		$Data['Kriteria'] = $this->db->get('Kriteria')->result_array();
		$this->load->view('Header');
	  $this->load->view('SubKriteria',$Data);
	  $this->load->view('Footer');
	}

	public function TambahSubKriteria(){
	  $this->load->database();
	  $this->db->insert('SubKriteria', array('IdKriteria' => $_POST['IdKriteriaSub'],'NamaSubKriteria' => $_POST['NamaSubKriteriaBaru']));
		$NamaSubKriteria = $_POST['NamaSubKriteriaBaru'];
		$NamaKriteria = $_POST['NamaKriteriaSub'];
		$query = "ALTER TABLE DataSiswa DROP COLUMN IF EXISTS $NamaKriteria";
		$this->db->query($query);
		$query = "ALTER TABLE DataSiswa ADD COLUMN $NamaSubKriteria Varchar(30)";
	  $this->db->query($query);
		echo 'ok';
	}

	public function UpdateSubKriteria(){
	  $this->load->database();
	  $this->db->where('IdSubKriteria', $_POST['EditIdSubKriteria']);
	  $this->db->update('SubKriteria', array('NamaSubKriteria' => $_POST['EditNamaSubKriteria'], 'Status' => $_POST['Status']));
		// $NamaSubKriteria = $_POST['EditNamaSubKriteria'];
		// $NamaSubKriteriaLama = $_POST['NamaSubKriteriaLama'];
		// $query = "ALTER TABLE DataSiswa CHANGE IF EXISTS $NamaSubKriteriaLama $NamaSubKriteria Varchar(30)";
	 //  $this->db->query($query);
		echo 'ok';
	}

	public function HapusSubKriteria(){
	  $this->load->database();
	  $this->db->delete('SubKriteria', array('IdSubKriteria' => $_POST['HapusIdSubKriteria']));
		$NamaSubKriteria = $_POST['NamaSubKriteria'];
		$NamaKriteria = $_POST['NamaKriteria'];
		$query = "ALTER TABLE DataSiswa DROP COLUMN $NamaSubKriteria";
	  $this->db->query($query);
		$CekKolomKriteria = $this->db->get_where('SubKriteria', array('IdKriteria' => $_POST['IdKriteria']))->num_rows();
		if ($CekKolomKriteria == 0) {
			$query = "ALTER TABLE DataSiswa ADD COLUMN $NamaKriteria Varchar(30)";
		  $this->db->query($query);
		}
		echo 'ok';
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
		$Data['TotalKriteria'] = $this->db->get('Kriteria')->num_rows();
		$query = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME = 'DataSiswa'";
	  $Data['FormSiswa'] = $this->db->query($query)->result_array();
		$this->load->view('Header');
	  $this->load->view('Perhitungan',$Data);
	  $this->load->view('Footer');
	}

}

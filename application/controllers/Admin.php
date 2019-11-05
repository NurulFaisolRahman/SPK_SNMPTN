<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login"){
			redirect(base_url());
		}
	}

	public function index(){
		// $this->load->view('Login');
	}

	public function Prodi(){
		$this->load->database();
		$Data['Prodi'] = $this->db->get('Prodi')->result_array();
		$Data['Kriteria'] = $this->db->get('Kriteria')->result_array();
		$Data['TotalKriteria'] = $this->db->get('Kriteria')->num_rows();
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
		$this->db->insert('Kriteria', array('NamaKriteria' => $_POST['NamaKriteriaBaru']));
		echo 'ok';
	}

	public function UpdateKriteria(){
	  $this->load->database();
	  $this->db->where('IdKriteria', $_POST['EditIdKriteria']);
	  $this->db->update('Kriteria', array('NamaKriteria' => $_POST['EditNamaKriteria']));
	  echo 'ok';
	}

	public function HapusKriteria(){
	  $this->load->database();
	  $this->db->delete('Kriteria', array('IdKriteria' => $_POST['HapusIdKriteria']));
	  echo 'ok';
	}

	public function SubKriteria(){
	  $this->load->database();
		$query = "SELECT Kriteria.NamaKriteria,SubKriteria.IdSubKriteria,SubKriteria.NamaSubKriteria FROM Kriteria,SubKriteria WHERE Kriteria.IdKriteria = SubKriteria.IdKriteria";
	  $Data['SubKriteria'] = $this->db->query($query)->result_array();
		$Data['Kriteria'] = $this->db->get('Kriteria')->result_array();
		$this->load->view('Header');
	  $this->load->view('SubKriteria',$Data);
	  $this->load->view('Footer');
	}

	public function TambahSubKriteria(){
	  $this->load->database();
	  $this->db->insert('SubKriteria', array('IdKriteria' => $_POST['IdKriteriaBaru'],'NamaSubKriteria' => $_POST['NamaSubKriteriaBaru']));
	  echo 'ok';
	}

	public function UpdateSubKriteria(){
	  $this->load->database();
	  $this->db->where('IdSubKriteria', $_POST['EditIdSubKriteria']);
	  $this->db->update('SubKriteria', array('IdKriteria' => $_POST['IdKriteriaBaru'],'NamaSubKriteria' => $_POST['EditNamaSubKriteria']));
	  echo 'ok';
	}

	public function HapusSubKriteria(){
	  $this->load->database();
	  $this->db->delete('SubKriteria', array('IdSubKriteria' => $_POST['HapusIdSubKriteria']));
	  echo 'ok';
	}

	public function Siswa(){
	  $this->load->database();
		$Data['Prodi'] = $this->db->get('Prodi')->result_array();
		$Data['Siswa'] = $this->db->get('Siswa')->result_array();
		$this->load->view('Header');
	  $this->load->view('Siswa',$Data);
	  $this->load->view('Footer');
	}

	public function TambahSiswa(){
	  $this->load->database();
	  $this->db->insert('Siswa', array(
			'NomorPendaftaran' => $_POST['NomorPendaftaranBaru'],
			'NPSNSekolah' => $_POST['NPSNSekolahBaru'],
			'Minat' => $_POST['PilihanMinat']));
	  echo 'ok';
	}

	public function UpdateSiswa(){
	  $this->load->database();
	  $this->db->where('NomorPendaftaran', $_POST['NomorPendaftaranLama']);
	  $this->db->update(
			'Siswa', array('NomorPendaftaran' => $_POST['EditNomorPendaftaran'],
			'NPSNSekolah' => $_POST['EditNPSNSekolah'],
			'Minat' => $_POST['PilihanEditMinat']));
	  echo 'ok';
	}

	public function HapusSiswa(){
	  $this->load->database();
	  $this->db->delete('Siswa', array('NomorPendaftaran' => $_POST['HapusSiswa']));
	  echo 'ok';
	}

}

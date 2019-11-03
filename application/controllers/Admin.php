<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index(){
		$this->load->view('Login');
	}

	public function CekLogin(){
  	$username = $_POST['Username'];
  	$password = $_POST['Password'];
		$this->load->database();
		$CekLogin = $this->db->get_where('Akun', array('Username' => $username,'Password' => $password))->num_rows();
		if($CekLogin == 0){
  		echo "Username / Password Salah";
  	}
  	else{
  		echo 'ok';
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

}

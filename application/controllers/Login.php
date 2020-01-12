<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function index(){
		$this->load->view('Login');
	}
  
  public function CekLogin(){
  	$username = $_POST['Username'];
  	$password = $_POST['Password'];
		$this->load->database();
    $Akun = $this->db->get_where('Akun', array('Username' => $username,'Password' => $password))->row_array();
		$CekLogin = $this->db->get_where('Akun', array('Username' => $username,'Password' => $password))->num_rows();
		if($CekLogin == 0){
  		echo "Username / Password Salah";
  	}
  	else{
      if ($Akun["Username"] == "admin") {
        echo "Admin";
      } else {
        echo "Siswa";
      }
			$DataSession = array('Status' => "Login", 'User' => $Akun["Username"]);
			$this->session->set_userdata($DataSession);
  	}
	}

  public function LogOut(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

}

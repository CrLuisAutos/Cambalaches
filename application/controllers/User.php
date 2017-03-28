<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	
	public function index()
	{
		
		$this->load->view('user/index.php');
		
	}

	public function login()
	{
		$this->load->view('login/index.php');
	}
	public function authenticate()
	{
		// objener valores
		$user = $this->input->post('userName');
		$pass = $this->input->post('pass');

		// consultar BD
		$this->load->model('User_model');
		$r = $this->User_model->authenticate($user, $pass);

		if(sizeof($r) > 0) {
			$this->session->set_userdata('user', $r[0]);
			redirect('user');
		} else {
			$this->session->set_flashdata('error', 'Datos Incorrectos');
			redirect(base_url(), 'refresh');
		}

	}
}

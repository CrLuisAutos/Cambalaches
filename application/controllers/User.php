<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	//carga de vistas
	public function index()
	{
		//carga la vista user index
		$this->load->view('user/index.php');
		
	}
		//carga el login
	public function login()
	{
		$this->load->view('login/index.php');
	}




	//carga de la base de datos
	//autenticar usuario
	public function autenticar()
	{
		// obtener valores
		$email = $this->input->post('email');
		$pass = ($this->input->post('pass')); //md5

 		// consultar BD
		$r = $this->User_model->autenticar($email, $pass);
		//validar si el usuario existe o no
		if(sizeof($r) > 0) {
			$this->session->set_userdata('user', $r[0]);
			redirect('user');
		} else {
			$this->mostrar_msj('**Credenciales Inválidos**');
		}

	}

	//Agrega un nuevo usuario a la base de datos
	public function crearUsuario()
	{

		$nombre= $this->input->post('nombre');
		$apellido= $this->input->post('apellido');
		$pass= $this->input->post('pass');
		$email= $this->input->post('email');
		//dejo el email por fuera, ya que puede poseer caracteres especiales
		$usuario = array('nombre' => $nombre, 'apellido' => $apellido,'password' => $pass);
		//recorro el arreglo
		foreach ($usuario as $dato) {
		//pregunto si los datos del arreglo posee algo que no sea alfanumerico
		 if(!ctype_alnum($dato)){

		 	$this->mostrar_msj('**No se permiten caracteres especiales**');
		 }
		}
		  $usuario['email']= $email; 
			$r=$this->User_model->validarCorreo($email);
			if (sizeof($r)>0) {
				$this->mostrar_msj('**Existe un usuario utilizando este correo**');
			}
			else{

		 	$r=$this->User_model->crearUsuario($usuario);
		 	if(sizeof($r)>0){
		 		redirect(base_url());
		 		}
		 	else{
		 		$this->mostrar_msj('**Ocurrio un error**');
		 	}
			}
		
	}
	//elimina la sesion del usuario
	public function closeSesion()
	{
		$this->session->sess_destroy('user');
		redirect(base_url());
	}
//redirecciona si hubo algun error por parte del usuario
	public function mostrar_msj($mensaje)
	{
		$this->session->set_flashdata('msj', $mensaje);
		redirect(base_url());
	}
	
}

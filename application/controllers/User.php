<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	//carga de vistas
	public function index()
	{
		$r=$this->User_model->cargarTodasPublicaciones();
		$data['lista']=$r;
		//carga la vista user index
		$this->load->view('user/index.php', $data);
		
	}
		//carga el login
	public function login($data='')
	{
		$this->load->view('login/index.php');
	}
	public function perfil()
	{
		$r= $this->cargarPublicaciones();
		$data['lista']= $r;
		$this->load->view('user/perfil.php', $data);
	}

	//carga de la base de datos
	//autenticar usuario
	public function autenticar()
	{
		// obtener valores
		$email = $this->input->post('email');
		$pass = md5(($this->input->post('pass')));

 		// consultar BD
		$r = $this->User_model->autenticar($email, $pass);
		//validar si el usuario existe o no
		if(sizeof($r) > 0) {
			$this->session->set_userdata('user', $r[0]);
			redirect('usuario');
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
		$pass= md5($pass);
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
	//carga las publicaciones del usuario actual
	public function cargarPublicaciones()
	{
		$r= $this->User_model->cargarPublicaciones($this->usuarioActual());
		return $r;
	}
	//agregar una nueva publicacion en la base
	public function publicar($publicacion)
	{
		$r= $this->User_model->publicar($publicacion);
		if (sizeof($r)>0) {
			redirect('perfil');
		}else{
			redirect(base_url());
		}

	}
	//actualiza los datos de una publicacion
	public function editarPublicacion()
	{
		$publicacion = array('nombre' => $this-> input->post('nombre'), 'descripcion'=>$this-> input->post('descripcion'), 'precio'=>$this-> input->post('precio'),
			'estado'=> $this->input->post('estado'));
		$r=$this->User_model->editarPublicacion($publicacion, $this->input->post('id'));
		redirect('perfil');
	}
	//ajax
	public function buscarPublicacion()
	{
		  $id = $this->input->post('id');
		  $r= $this->User_model->buscarPublicacion($id);
		  $data['publicacion']= $r;
		  $r= json_encode($data);
		  echo $r;
	}
	//borra un publicacion
	public function borrarPublicacion()
	{
		$id=$this->input->get('code');
		$this->obtenerImagen($id);
		$this->User_model->borrarPublicacion($id);
		redirect('perfil');
	}
	//ajax
	public function eliminarHistorial()
	{
		$this->User_model->eliminarHistorial($this->input->post('id'));
	}
	//verifica que el deseo del usuario no se repita
	public function verificarDeseo($id_publicacion,$id_usuario)
	{
		return $this->User_model->verificarDeseo($id_publicacion, $id_usuario);
	}
	//obtiene datos de una publicacion deseada
	public function guardarPublicacionDeseada()
	{
		$id_usuario = $this->input->post('id_usuario');
		$id_publicacion = $this->input->post('id_publicacion');
		//se verifica que el deseo en la publicacion no exista.
		$r= $this->verificarDeseo($id_publicacion, $id_usuario);
		if($r==0){
			$datos = array('id_usuario' => $id_usuario,'id_publicacion'=> $id_publicacion);
			$this->User_model->guardarPublicacionDeseada($datos);
		}

	}
	public function mostrarDeseo()
	{
		$r=$this->User_model->mostrarDeseo($this->input->post('id'));
		if (sizeof($r)>0) {
			$data['deseo']= $r;
		  	$r= json_encode($data);
		  	echo $r;
		}
	}
	public function borrarDeseo()
	{
		$id=$this->input->get('code');
		$this->User_model->borrarDeseo($id);
	}
	public function obtenerImagen($id)
	{
		$r= $this->User_model->obtenerImagen($id);
		unlink("./util/img/".$r[0]['foto']);  //borra el archivo
	}
	//subir imagenes al servidor
	public function do_upload()
    {

        $config['upload_path'] = "./util/img/";
        $config['allowed_types'] = "jpg|png";
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload()){
    		$datos['error'] = $this->upload->display_errors();
    		foreach ($datos as $error => $value) {
    			echo $value;
    		}
        }
        else{
    		$datos['success'] = $this->upload->data();
    		$publicacion = array('nombre' => $this-> input->post('nombre'), 'descripcion'=>$this-> input->post('descripcion'), 'precio'=>$this-> input->post('precio'), 'foto'=>$datos['success']['file_name'], 'id_usuario'=> $this->usuarioActual(), 'estado'=> $this-> input->post('estado'));
    		$this->publicar($publicacion);

        }
    }
	//buscar un publicacion
	public function busquedaUsuario()
	{
		$buscar=$this->input->get('search');
		$r= $this->User_model->busquedaUsuario($buscar);
		$data['lista']= $r;
		$this->load->view('user/index.php', $data);
	}
	public function mostrarComentarios()
	{
		$r=$this->User_model->mostrarComentarios($this->input->post('id'));
		$data['comentario']= $r;
		$r= json_encode($data);
		echo $r;
	}
	//guadar un comentario
	public function guardarComentario()
	{
		$comentario = array('id_publicacion' => $this->input->post('id_publicacion'),'comentario'=>$this->input->post('comentario'),'id_usuario'=> $this->usuarioActual());
		$this->User_model->guardarComentario($comentario);
	}
	public function eliminarComentario()
	{
		$this->User_model->eliminarComentario($this->input->post('id'));
	}
	// muestra el id del usuario actual
	public function usuarioActual()
	{
		$userdata= $this->session->userdata('user');
		if($userdata!=null){
		return $userdata['id'];
		}else{
			redirect(base_url());
		}
	}
	//elimina la sesion del usuario
	public function closeSesion()
	{
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
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

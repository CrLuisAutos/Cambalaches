<?php
class User_model extends CI_Model {

  //verifica que el usuario ingreso correctamente los credenciales de acceso
  function autenticar($email, $pass) {

    $query = $this->db->get_where('users',
      array('email' => $email, 'password' => $pass));

	  return $query->result_array();
  }
  
  //valida que el correo no se repita
  public function validarCorreo($user)
  {
    $query= $this->db->get_where('users',array('email' => $user));
    return $query->result_object();
  }
  //crea un nuevo usuario
  public function crearUsuario($user)
  {
  	 $r = $this->db->insert('users', $user);
    return $r;
  }
  //registra una nueva publicacion en la base de datos
  public function publicar($publicacion)
  {
     $r = $this->db->insert('publicacion', $publicacion);
    return $r;
  }
  //obtiene las publicaciones hechas por un usuario
  public function cargarPublicaciones($id)
  {
    $query= $this->db->get_where('publicacion',array('id_usuario' => $id));
    return $query->result_array();
  }

}
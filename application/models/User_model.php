<?php
class User_model extends CI_Model {

  //verifica que el usuario ingreso correctamente los credenciales de acceso
  function autenticar($email, $pass) {

    $query = $this->db->get_where('users',
      array('email' => $email, 'password' => $pass));

	  return $query->result_object();
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

}
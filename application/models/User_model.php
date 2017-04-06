<?php
class User_model extends CI_Model {

  function autenticar($email, $pass) {

    $query = $this->db->get_where('users',
      array('email' => $email, 'password' => $pass));

	  return $query->result_object();
  }

  public function crearUsuario($user)
  {
  	 $r = $this->db->insert('users', $user);
    return $r;
  }

}
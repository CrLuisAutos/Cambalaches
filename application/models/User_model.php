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
  //carga todas las publicaciones
  public function cargarTodasPublicaciones()
  {
      $query= $this->db->query('SELECT p.id id_publicacion,p.descripcion,p.estado,p.foto,p.nombre nombre_publicacion,p.precio, u.id id_usuario, u.nombre nombre_usuario, u.apellido 
FROM cambalache.users u INNER JOIN cambalache.publicacion p
ON u.id = p.id_usuario');
    return $query->result_array();
  }
  //obtiene las publicaciones hechas por un usuario
  public function cargarPublicaciones($id)
  {
    $query= $this->db->get_where('publicacion',array('id_usuario' => $id));
    return $query->result_array();
  }
  //muestra los datos de la publicacion seleccionada
  public function buscarPublicacion($id)
  {
     $query = $this->db->get_where('publicacion',
      array('id' => $id));

    return $query->result_array();
  }
  //actualiza una publicacion
  public function editarPublicacion($publicacion, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('publicacion', $publicacion);

  }
  //elimina una publicacion
  public function borrarPublicacion($id)
  {
    $this->db->delete('publicacion', array('id' => $id)); 
  }

}
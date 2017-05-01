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
    $this->db->select('p.id id_publicacion,p.descripcion, p.estado, p.foto, p.nombre nombre_publicacion, p.precio, u.id id_usuario, u.nombre nombre_usuario, u.apellido');
    $this->db->from('users u'); 
    $this->db->join('publicacion p' , 'u.id = p.id_usuario');
    $this->db->order_by('p.id','desc'); 
    $query = $this->db->get(); 
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
    $this->db->delete('comentario', array('id_publicacion' => $id)); 
    $this->db->delete('publicacion', array('id' => $id)); 
  }
  //verifica que un deseo de un usuario no se repita
  public function verificarDeseo($id_publicacion, $id_usuario)
  {
    $query= $this->db->get_where('deseo', array('id_publicacion' => $id_publicacion ,'id_usuario' => $id_usuario ));
    return $query->num_rows();
  }
  public function guardarPublicacionDeseada($datos)
  {
    $this->db->insert('deseo', $datos);
  }
  public function mostrarDeseo($id_usuario)
  {
    $this->db->select('p.id id_publicacion,p.descripcion, p.estado, p.foto, p.nombre nombre_publicacion, p.precio, u.id id_usuario, u.nombre nombre_usuario, u.apellido, d.id');
    $this->db->from('deseo d'); 
    $this->db->join('publicacion p' , 'p.id = d.id_publicacion');
    $this->db->join('users u' , 'u.id = p.id_usuario');
    $this->db->where('d.id_usuario', $id_usuario);
    $this->db->order_by('d.id','desc'); 
    $query = $this->db->get(); 
    return $query->result_array();
  }
  //elimina todas las publicaciones de un usuario
  public function eliminarHistorial($id)
  {
    $this->db->delete('comentario', array('id_usuario' => $id));
    $this->db->delete('publicacion', array('id_usuario' => $id));
  }
  public function obtenerImagen($id)
  {
    $this->db->select('foto');
    $this->db->from('publicacion');
    $this->db->where('id', $id);
    $query = $this->db->get(); 
    return $query->result_array();

  }
  //obtiene los comentarios de una publicacion
  public function mostrarComentarios($id)
  {
   $this->db->select('c.comentario,c.id,u.nombre, u.apellido, u.id id_usuario');
   $this->db->from('comentario c'); 
   $this->db->join('publicacion p', 'c.id_publicacion=p.id');
   $this->db->join('users u', 'u.id= c.id_usuario');
   $this->db->where('c.id_publicacion',$id);
   $this->db->order_by('c.id','asc');         
   $query = $this->db->get(); 
   return $query->result_array();
  }
  //guadar comentarios
  public function guardarComentario($comentario)
  {
    $this->db->insert('comentario', $comentario);
  }
  public function eliminarComentario($id)
  {
    $this->db->delete('comentario', array('id' => $id));
  }
  //busca un publicacion que posea cierta informacion
  public function busquedaUsuario($valor)
  {
    $this->db->select('p.id id_publicacion,p.descripcion, p.estado, p.foto, p.nombre nombre_publicacion, p.precio, u.id id_usuario, u.nombre nombre_usuario, u.apellido');
    $this->db->from('users u');
    //primero comparo
    $this->db->like('p.nombre',$valor);
    $this->db->or_like('p.descripcion',$valor);
    //luego unifico
    $this->db->join('publicacion p' , 'u.id = p.id_usuario');
    $this->db->order_by('p.id','desc'); 
    $query = $this->db->get(); 
    return $query->result_array();
  }
}
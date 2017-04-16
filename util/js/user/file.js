jQuery(document).ready(function($) {
var base_url= window.location.origin;
var id_publicacion="";
	//cargar los comentarios
	$(".btnComentario").click(function() {
		id_publicacion= this.id;
		mostrarComentarios();
	});
	//guardar comentario
	$("#comentar").click(function(event) {
		var comentario = document.getElementById("text").value;  
		$.ajax({
		  	 type:  'POST',
                url:  base_url+"/Cambalaches/guardarComentario",
                data:  {
                	'id_publicacion': id_publicacion,
                	'comentario' : comentario
                },
                success:function data() {
                	 mostrarComentarios();           	
                }
		  })
		$('textarea').val('');
		$('textarea').focus();
	});
	//mostrar los comentarios de la publicacion
	function mostrarComentarios() {
		$.ajax({
		  	 type:  'POST',
                url:  base_url+"/Cambalaches/mostrarComentarios",
                data:  {
                	'id': id_publicacion
                },
                success:function data(datos) {
                	 var datosJson= $.parseJSON(datos);
                	$("#comments-list li").closest('li').remove();
                	 $.each(datosJson, function(val) {
                	 	 for (var i = 0; i < datosJson[val].length; i++) {
                	$(".comments-container ul").append("<li><div class='comment-main-level'><div class='comment-box'><div class='comment-head'><h6 class='comment-name'><a>"+datosJson.comentario[i].id_usuario+"</a></h6><i class='fa fa-reply'></i><i class='fa fa-heart'></i></div><div class='comment-content'>"+datosJson.comentario[i].comentario+"</div></div></div></li>");
                	 																																																															//$("#editNombre").val(datosJson.publicacion[0].nombre);              	
                	 	 }
                	 });
                }
		  })
	}


});
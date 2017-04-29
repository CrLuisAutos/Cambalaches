jQuery(document).ready(function($) {
    var usuarioActual = $(".userData").attr('id');
    var base_url = window.location.origin;
    var id_publicacion = "";
    //cargar los comentarios
    $(".btnComentario").click(function() {
        id_publicacion = this.id;
        mostrarComentarios();
    });
    //guardar comentario
    $("#comentar").click(function(event) {
        var comentario = (document.getElementById("text").value).trim();
        if (comentario.length > 0) {
            $.ajax({
                type: 'POST',
                url: base_url + "/Cambalaches/guardarComentario",
                data: {
                    'id_publicacion': id_publicacion,
                    'comentario': comentario
                },
                success: function data() {
                    mostrarComentarios();
                }
            })
            $('textarea').val('');
            $('textarea').focus();
        }
    });
    //mostrar los comentarios de la publicacion
    function mostrarComentarios() {
        $.ajax({
            type: 'POST',
            url: base_url + "/Cambalaches/mostrarComentarios",
            data: {
                'id': id_publicacion
            },
            success: function data(datos) {
                var datosJson = $.parseJSON(datos);
                $("#comments-list li").closest('li').remove();
                $.each(datosJson, function(val) {
                    for (var i = 0; i < datosJson[val].length; i++) {
                        //permite borrar solo si el comentario le pertenece
                        if (datosJson.comentario[i].id_usuario == usuarioActual) {
                            $(".comments-container ul").append("<li><div class='comment-main-level'><div class='comment-box'><div class='comment-head'><h6 class='comment-name'><a>" + datosJson.comentario[i].nombre + " " + datosJson.comentario[i].apellido +
                                "</a></h6><button class='btn btnEliminar pull-right' id=" + datosJson.comentario[i].id + "><span class='glyphicon glyphicon-remove'></span></button><i class='fa fa-reply'></i><i class='fa fa-heart'></i></div><div class='comment-content'>" +
                                datosJson.comentario[i].comentario + "</div></div></div></li>");
                        } else {
                            $(".comments-container ul").append("<li><div class='comment-main-level'><div class='comment-box'><div class='comment-head'><h6 class='comment-name'><a>" + datosJson.comentario[i].nombre + " " + datosJson.comentario[i].apellido +
                                "</a></h6><i class='fa fa-reply'></i><i class='fa fa-heart'></i></div><div class='comment-content'>" +
                                datosJson.comentario[i].comentario + "</div></div></div></li>");
                        }
                    }
                });
            }
        })
    }
    //Elimina un comentario
    $("#comments-list").on("click", ".btnEliminar", function() {
        $.ajax({
            type: 'POST',
            url: base_url + "/Cambalaches/eliminarComentario",
            data: {
                'id': this.id,
            },
            success: function data() {
                mostrarComentarios();
            }
        })

    });

});
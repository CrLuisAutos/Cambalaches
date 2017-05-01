jQuery(document).ready(function($) {
    var base_url = window.location.origin;
    var usuarioActual = $(".usuarioActual").attr('id');
    //editar una publicacion existente
    $(".btneditar").click(function(event) {
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: base_url + "/Cambalaches/buscarPublicacion",
            data: {
                'id': id
            },
            success: function data(datos) {
                var datos2 = $.parseJSON(datos);
                $("#editNombre").val(datos2.publicacion[0].nombre);
                $("#editPrecio").val(datos2.publicacion[0].precio);
                $("#editDescripcion").val(datos2.publicacion[0].descripcion);
                $("#editId").val(datos2.publicacion[0].id);
                if (datos2.publicacion[0].estado == 0) {
                    $("#venta").attr('checked', true);
                } else if (datos2.publicacion[0].estado == 1) {
                    $("#vendido").attr('checked', true);
                } else if (datos2.publicacion[0].estado == 2) {
                    $("#cambalache").attr('checked', true);
                }
            }
        })
    });
    //elimina todas las publicaciones del usuario actual
    $("#btnEliminar").click(function(event) {
        $.ajax({
            type: 'POST',
            url: base_url + "/Cambalaches/eliminarHistorial",
            data: {
                'id': usuarioActual
            },
            success: function data(datos) {
                $("#container").html("");

            }
        })
    });

    $("#container").on("click", ".btnDinamComentario", function() {
        id_publicacion = this.id;
        mostrarComentarios();

    });
    //muestra las publicaciones deseadas por el usuario
    $('#btnDeseo').click(function(event) {
        $.ajax({
            type: 'POST',
            url: base_url + "/Cambalaches/mostrarDeseo",
            data: {
                'id': usuarioActual
            },
            success: function data(datos) {
                $("#container").html("");
                $("#titulo").text('Publicaciones favoritas');
                $("#titulo").removeClass('label-success');
                $("#titulo").addClass('label-danger');
                var arrayDatos = $.parseJSON(datos);
                $.each(arrayDatos, function(val) {
                    for (var i = 0; i < arrayDatos[val].length; i++) {
                        console.log(arrayDatos.deseo[i].id);
                        var stringAppend = "<div class='col-md-3'><div class='row'><div class='col-sm-9 col-lg-9 col-md-9'>" +
                            "<div class='thumbnail'><h3 class='bg-info' align='center'>" + arrayDatos.deseo[i].nombre_usuario + " " + arrayDatos.deseo[i].apellido + "</h3>";
                        if (arrayDatos.deseo[i].estado == 0) {
                            stringAppend += "<h4 class='text-center label-success'>Oferta: En venta</h4>";
                        } else if (arrayDatos.deseo[i].estado == 2) {
                            stringAppend += "<h4 class='text-center label-warning'>Oferta: Cambalache</h4>";
                        }
                        stringAppend += "<img src='util/img/" + arrayDatos.deseo[i].foto + "' class='img-responsive'>";
                        stringAppend += "<div class = 'caption'><h4 class = 'pull-right'> ₡" + arrayDatos.deseo[i].precio + "</h4>";
                        stringAppend += "<h4 class = 'pull-left'><a>" + arrayDatos.deseo[i].nombre_publicacion + "</a></h4>";
                        stringAppend += "<br><br><p class='pull-left'>" + arrayDatos.deseo[i].descripcion + "</p> <br> <br>";
                        stringAppend += "<button class = 'btnDinamComentario btn-link left' type='button' data-toggle='modal' data-target= '#myModal' id ='" + arrayDatos.deseo[i].id_publicacion+"'> Comentarios </button>";
                        stringAppend += "<button class='btn btn-link pull-right'><a href='borrarDeseo/?code=" + arrayDatos.deseo[i].id + "'><span class='glyphicon glyphicon-trash pull-right' aria-hidden='true'></span></a></button>";
                        stringAppend += "</div></div></div>";
                        $("#container").append(stringAppend);
                    }
                });


            }
        })

    });
});
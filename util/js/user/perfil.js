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
                    $("#venta").attr('checked', 'true');
                } else {
                    $("#vendido").attr('checked', 'true');
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
});
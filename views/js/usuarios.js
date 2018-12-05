/*Subir Foto*/ 

$(".nuevaFoto").change(function(){

    var imagen = this.files[0];

    /* Validacion */

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

        $(".nuevaFoto").val("");

        swal({
            title: "Error al subir la imagen",
            text: "Solo se admiten imagenes en formato JPG o PNG",
            type: "error",
            confirmButtonText: "Cerrar"
        });
    }else if(imagen["size"] > 5120000){

        $(".nuevaFoto").val("");

        swal({
            title: "Error al subir la imagen",
            text: "Error la imagen no puede pesar mas de 5 Mb",
            type: "error",
            confirmButtonText: "Cerrar"
        });
    }else {

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen);
        })
    }

})

/**Editar Usuario */

$(".btnEditarUsuario").click(function(){

    var idUsuario = $(this).attr("idUsuario");
    
    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({

        url:"ajax/usuarios.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

                $("#editarNombre").val(respuesta["nombre"]);
                $("#editarUsuario").val(respuesta["nick"]);
                $("#editarPerfil").html(respuesta["perfil"]);
                $("#editarPerfil").val(respuesta["perfil"]);
                $("#fotoActual").val(respuesta["imagen"]);

                $("#passwordActual").html(respuesta["password"]);                
                if(respuesta["imagen"] != ""){

                    $(".previsualizarEditar").attr("src", respuesta["imagen"]);

                }else{

                    $(".previsualizarEditar").attr("src", "views/img/usuarios/default_user.png");
                }

        }
    });
})

/*
*   Activar Usuario 
*/

$(".btnActivar").click(function(){

    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({

        url:"ajax/usuarios.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

        }
    })

    if(estadoUsuario == 0){

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario', 1);

    }else{

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activo');
        $(this).attr('estadoUsuario', 0);
    }

})

/**
 * Comprobar nombre de Usuario
 */

$("#nuevoUsuario").change(function(){

    $(".alert").remove();

    var usuario = $(this).val();

    var datos = new FormData();
    datos.append("validarUsuario", usuario);

    $.ajax({

        url:"ajax/usuarios.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            if(respuesta){
                $("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este Usuario ya existe.</div>');

                $("#nuevoUsuario").val("");

            }
        }
    })
})

/**
 * Eliminar Usuario
 */


 $(".btnEliminarUsuario").click(function(){

    var idUsuario = $(this).attr("idUsuario");
    var fotoUsuario = $(this).attr("fotoUsuario");
    var usuario = $(this).attr("usuario");

    swal({
        title:  '¿Estas seguro que deseas eliminar este usuario?',
        text:   "Si no estas seguro puedes cancelar la acción",
        type:   'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Eliminar el Usuario'
    }).then((result)=>{

        if(result.value){

            window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
        }

    })

 })
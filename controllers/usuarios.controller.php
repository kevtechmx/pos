<?php

class ControllerUsuarios {

    static public function ctrIngresoUsuario() {

        if (isset($_POST["ingUsuario"])) {

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])) {

                $tabla = "admin_usuarios";

                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $item = "nick";
                $valor = $_POST["ingUsuario"];

                $respuesta = ModelUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

                

                if ($respuesta["nick"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {

                    if ($respuesta["estado"] == 1){

                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["id"] = $respuesta["id"];
                    $_SESSION["nombre"] = $respuesta["nombre"];
                    $_SESSION["nick"] = $respuesta["nick"];
                    $_SESSION["imagen"] = $respuesta["imagen"];
                    $_SESSION["perfil"] = $respuesta["perfil"];

                    /**
                     * Registrar ultimo Login
                     */

                    date_default_timezone_set('America/Mexico_City');
                    
                    $fecha = date('Y-m-d');
                    $hora = date('H:i:s');

                    $fechaActual = $fecha.' '.$hora;

                    $item1 = "ultimo_login";
                    $valor1 = $fechaActual;

                    $item2 = "id";
                    $valor2 = $respuesta["id"];
                    
                    $ultimoLogin = ModelUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                    if($ultimoLogin == "ok"){

                        echo '<script>

                        window.location = "inicio";
    
                        </script>';
                    }

                    }else {

                        echo '<br><div class="alert alert-danger">El Usuario esta desactivado</div>';
                    }

                } else {

                    echo '<br><div class="alert alert-danger">No se puede iniciar sesion, revisa tus datos e intenta de nuevo. </div>';
                }
            }
        }
    }

    /**
     * Registro de Usuario
     */
    static public function ctrCrearUsuario() {

        if (isset($_POST["nuevoUsuario"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])) {

                /*
                * Validar Imagen  
                */
                $ruta = "";

                if (isset($_FILES["nuevaFoto"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*                     
                    * Crear Directorio 
                    */

                    $directorio = "views/img/usuarios/" . $_POST["nuevoUsuario"];

                    mkdir($directorio, 0755);

                    /*                     
                    * Cambios de acuerdo al tipo de imagen 
                    */

                    if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".jpeg";

                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAlto, $nuevoAncho);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["nuevaFoto"]["type"] == "image/png") {

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAlto, $nuevoAncho);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }


                $tabla = "admin_usuarios";

                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array("nombre" => $_POST["nuevoNombre"],
                    "nick" => $_POST["nuevoUsuario"],
                    "password" => $encriptar,
                    "perfil" => $_POST["nuevoPerfil"],
                    "imagen" => $ruta);

                $respuesta = ModelUsuarios::mdlIngresarUsuario($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>

                swal({

                    type: "success",
                    title: "¡El usuario ha sido guardado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){
                    
                        window.location = "usuarios";

                    }

                });
            

            </script>';
                }
            } else {
                
                  echo '<script>

                  swal({

                  type: "error",
                  title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"

                  }).then(function(result){

                  if(result.value){

                  window.location = "usuarios";

                  }

                  });


                  </script>';
              
            }
        }
    }

    /* =============================================
      MOSTRAR USUARIO
      ============================================= */

    static public function ctrMostrarUsuarios($item, $valor) {

        $tabla = "admin_usuarios";
        $respuesta = ModelUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }

    /*     
    * Editar Usuarios 
    */

    static public function ctrEditarUsuario() {
        if (isset($_POST["editarUsuario"])) {
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

                /*
                 * edita Foto
                 */

                $ruta = $_POST["imagenActual"];

                if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*                     
                    * Crear Directorio 
                    */

                    $directorio = "views/img/usuarios/" . $_POST["editarUsuario"];
                    /**
                     * Preguntar si existe imagen
                     */
                    if (!empty($_POST["imagenActual"])) {

                        unlink($_POST["imagenActual"]);

                    } else {

                        mkdir($directorio, 0755);
                    }

                    /*
                    * Cambios de acuerdo al tipo de imagen 
                    */

                    if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".jpeg";

                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAlto, $nuevoAncho);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["editarFoto"]["type"] == "image/png") {

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAlto, $nuevoAncho);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "admin_usuarios";

                if ($_POST["editarPassword" != ""]) {

                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {

                        echo '<script>

                        swal({
        
                            type: "error",
                            title: "¡La contraseña no puede ir vacía o utilizar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
        
                        }).then((result) =>{
        
                            if(result.value){
                            
                                window.location = "usuarios";
        
                            }
        
                        });
                    
        
                    </script>';
                    }
                } else {

                    $encriptar = $_POST["passwordActual"];
                }

                $datos = array("nombre" => $_POST["editarNombre"],
                    "nick" => $_POST["editarUsuario"],
                    "password" => $encriptar,
                    "perfil" => $_POST["editarPerfil"],
                    "imagen" => $ruta);

                $respuesta = ModelUsuarios::mdlEditarUsuarios($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
    
                    swal({
    
                        type: "success",
                        title: "¡El usuario ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
    
                    }).then(function(result){
    
                        if(result.value){
                        
                            window.location = "usuarios";
    
                        }
    
                    });
                
    
                </script>';
                }
            }
        } else {

            echo '<script>

              swal({

              type: "error",
              title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              closeOnConfirm: false

              }).then((result){

              if(result.value){

              window.location = "usuarios";

              }

              });


              </script>';
        }
    }

    /**
     * Borrar Usuario
     */

     static public function  ctrBorrarUsuario(){

        if(isset($_GET["idUsuario"])){

            $tabla = "admin_usuarios";
            $datos = $_GET["idUsuario"];

            if($_GET["fotoUsuario"] != ""){

				unlink($_GET["fotoUsuario"]);
				rmdir('views/img/usuarios/'.$_GET["usuario"]);


            }

            $respuesta = ModelUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}	
        }
     }

}

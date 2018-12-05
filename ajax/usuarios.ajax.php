<?php

require_once "../controllers/usuarios.controller.php";
require_once "../models/usuarios.model.php";

class AjaxUsuarios{

    /**Editar Usuario */

    public $idUsuario;

    public function ajaxEditarUsuario(){

        $item = "id";
        $valor = $this->idUsuario;

        $respuesta = ControllerUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }

    /**
     * Activar Usuario;
     */

     public $activarUsuario;
     public $activarId;

    public function ajaxActivarUsuario(){

        $tabla = "admin_usuarios";

        $item1 = "estado";

        $valor1 = $this->activarUsuario;

        $item2 = "id";

        $valor2 = $this->activarId;

        $respuesta = ModelUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

     }

    /**
     * Validar Usuario no repetido
     */

     public $validarUsuario;

    public function ajaxValidarUsuario(){


        $item = "nick";
        $valor = $this->validarUsuario;

        $respuesta = ControllerUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);        

     }

}

/**Editar Usuario */

if(isset($_POST["idUsuario"])){

    $editar = new AjaxUsuarios();
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar -> ajaxEditarUsuario();
}

    /**
     * Activar Usuario;
     */

if(isset($_POST["activarUsuario"])){

    $activarUsuario = new AjaxUsuarios();
    $activarUsuario -> activarUsuario = $_POST["activarUsuario"];
    $activarUsuario -> activarId = $_POST["activarId"];
    $activarUsuario -> ajaxActivarUsuario();

}     

/**
 * Validar Usuario no Repetido
 */

 if(isset($_POST["validarUsuario"])){

    $valUsuario = new AjaxUsuarios();
    $valUsuario -> validarUsuario = $_POST["validarUsuario"];
    $valUsuario -> ajaxValidarUsuario();
 }
<?php

require_once "../controllers/categorias.controller.php";
require_once "../models/categorias.model.php";

class AjaxCategorias{

    /**Editar Categoria */

    public $idCategoria;

    public function ajaxEditarCategoria(){

        $item = "id";
        $valor = $this->idCategoria;

        $respuesta = ControllerCategorias::ctrMostrarCategorias($item, $valor);

        echo json_encode($respuesta);

    }

}

/**Editar Categoria */

if(isset($_POST["idCategoria"])){

    $categoria = new AjaxCategorias();
    $categoria -> idCategoria = $_POST["idCategoria"];
    $categoria -> ajaxEditarCategoria();
}

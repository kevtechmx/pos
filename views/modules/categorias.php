<div class="content-wrapper">
  <!--Titulos-->
  <section class="content-header">

    <h1>
      Administrar Categorías
    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Categorías</li>

    </ol>

  </section>
  <!--Titulos-->
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">Agregar Categoría</button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Categoría</th>
              <th>Acciones</th>
            </tr>
          <tbody>
<?php 
$item = null;
$valor = null;
$categorias = ControllerCategorias::ctrMostrarCategorias($item, $valor);

foreach ($categorias as $key => $value){
  echo '
  <tr>
              <td>'.($key+1).'</td>
              <td class="text-uppercase">'.$value["categoria"].'</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning btn-sm btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria" type="button"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger btn-sm btnBorrarCategoria" idCategoria="'.$value["id"].'" type="button"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>
  ';
}
?>
          </tbody>
          </thead>
        </table>

      </div>

      <div class="box-footer">
        Footer
      </div>

    </div>

  </section>

</div>

<!--Modal-->

<!-- Modal Agregar Categoria -->
<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <form role="form" method="post">
      <div class="modal-header" style="background:#333333; color:white">
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
        <h4 class="modal-title">Agregar Categoría</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-th"></i></div>
              <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Nombre de la Categoria"
                required>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary pull-right">Guardar Categoría</button>
      </div>

      <?php
      $crearCategoria = new ControllerCategorias();
      $crearCategoria -> ctrCrearCategoria();
      ?>
    </form>
    </div>

  </div>
</div>

<!-- Modal Editar Categoria -->
<div id="modalEditarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <form role="form" method="post">
      <div class="modal-header" style="background:#333333; color:white">
        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
        <h4 class="modal-title">Editar Categoría</h4>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-th"></i></div>
              <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>

              <input type="hidden"  name="idCategoria" id="idCategoria" required>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary pull-right">Guardar Cambios</button>
      </div>

      <?php
      $editarCategoria = new ControllerCategorias();
      $editarCategoria -> ctrEditarCategoria();
      ?>
    </form>
    </div>

  </div>
</div>

      <?php
      $borrarCategoria = new ControllerCategorias();
      $borrarCategoria -> ctrBorrarCategoria();
      ?>
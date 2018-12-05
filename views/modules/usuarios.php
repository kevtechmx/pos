<div class="content-wrapper">
  <!--Titulos-->
  <section class="content-header">

    <h1>
      Administrar Usuarios
    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Usuarios</li>

    </ol>

  </section>
  <!--Titulos-->
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregaUsuario">Agregar Usuario</button>

      </div>
      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ultimo Login</th>
              <th>Acciones</th>
            </tr>

          </thead>
          <tbody>
            <?php 

            $item = null;
            $valor = null;
            
            $usuarios = ControllerUsuarios::ctrMostrarUsuarios($item, $valor);

            foreach ($usuarios as $key => $value){
              echo '
              <tr>
              <td>'.($key+1).'</td>
              <td>'.$value["nombre"].'</td>
              <td>'.$value["nick"].'</td>';

              if($value["imagen"] != ""){

                echo '<td><img src="'.$value["imagen"].'" alt="imagen_usuario" width="40px" class="img-thumbnail"></td>';

              }else{

                echo '<td><img src="views/img/usuarios/default_user.png" alt="imagen_usuario" width="40px" class="img-thumbnail"></td>';
              }

              echo '<td>'.$value["perfil"].'</td>';

              if($value["estado"] != 0){
                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activo</button></td>';
              }else{
                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';
              }
              

              echo '<td>'.$value["ultimo_login"].'</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning btn-xs btnEditarUsuario" idUsuario="'.$value["id"].'" type="button" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger btn-xs btnEliminarUsuario" type="button" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["imagen"].'" Usuario="'.$value["nick"].'"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>
              
              ';
            }
            
            ?>
          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--Modal-->

<!-- Modal Agregar Usuario -->
<div id="modalAgregaUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header" style="background:#333333; color:white">
          <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
          <h4 class="modal-title">Agregar Usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input type="text" class="form-control input-sm" name="nuevoNombre" placeholder="Nombre" required>
                  </div>
                </div>
                <!--Nombre-->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                    <input type="text" class="form-control input-sm" name="nuevoUsuario" id="nuevoUsuario" placeholder="Usuario" required>
                  </div>
                </div>
                <!--Usuario-->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                    <input type="password" class="form-control input-sm" name="nuevoPassword" placeholder="Password"
                      required>
                  </div>
                </div>
                <!--Contraseña-->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-users"></i></div>
                    <select class="form-control input-sm" name="nuevoPerfil">
                      <option value="" default>Perfil</option>
                      <option value="Administrador">Administrador</option>
                      <option value="Especial">Especial</option>
                      <option value="Vendedor">Vendedor</option>
                    </select>
                  </div>
                </div>
                <!--Perfil-->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <img src="views/img/usuarios/default_user.png" class="img-thumbnail previsualizar" width="100px" alt="imgUsuario">
                  <input type="file" id="nuevaFoto" name="nuevaFoto" class="nuevaFoto" style="display: none;" />
                  <p class="help-block">Tamaño máximo 2MB</p>
                  <input type="button" class="btn btn-default btn-sm" value="Examinar..." onclick="document.getElementById('nuevaFoto').click();" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

        <?php

          $crearUsuario = new ControllerUsuarios();
          $crearUsuario -> ctrCrearUsuario();

        ?>

      </form>

      </form>
    </div>

  </div>

</div>
<!-- Modal Editar Usuario -->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background:#333333; color:white">
            <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
            <h4 class="modal-title">Editar Usuario</h4>
          </div>
          <div class="modal-body">
            <div class="box-body">
  
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                      <input type="text" class="form-control input-sm" name="editarNombre" id="editarNombre" value="" required>
                    </div>
                  </div>
                  <!--Nombre-->
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-key"></i></div>
                      <input type="text" class="form-control input-sm" name="editarUsuario" id="editarUsuario" value="" readonly>
                    </div>
                  </div>
                  <!--Usuario-->
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                      <input type="password" class="form-control input-sm" name="editarPassword" placeholder="Nueva Contraseña">
                    </div>
                    <input type="hidden" id="passwordActual" name="passwordActual">
                  </div>
                  <!--Contraseña-->
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-users"></i></div>
                      <select class="form-control input-sm" name="editarPerfil">
                        <option value="" id="editarPerfil">Perfil</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Especial">Especial</option>
                        <option value="Vendedor">Vendedor</option>
                      </select>
                    </div>
                  </div>
                  <!--Perfil-->
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <img src="views/img/usuarios/default_user.png" class="img-thumbnail previsualizarEditar" width="100px" alt="imgUsuario">
                    <input type="hidden" name="fotoActual" id="fotoActual">
                    <input type="file" id="editarFoto" name="editarFoto" class="nuevaFoto" style="display: none;" />
                    <p class="help-block">Tamaño máximo 2MB</p>
                    <input type="button" class="btn btn-default btn-sm" value="Examinar..." onclick="document.getElementById('editarFoto').click();" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
  
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
  
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
  
          </div>
         <?php

            $editarUsuario = new ControllerUsuarios();
            $editarUsuario -> ctrEditarUsuario();

         ?>


        </form>
  
        </form>
      </div>
  
    </div>
  
  </div>

          <?php

$borrarUsuario = new ControllerUsuarios();
$borrarUsuario -> ctrBorrarUsuario();

?>
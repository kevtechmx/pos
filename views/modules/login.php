<div id="back-login"></div>

<div class="login-box">

  <div class="login-box-body">
        <div class="login-logo">

                <img src="views/img/template/Logo_full.png" alt="Logo" class="img-responsive" >
            
              </div>
            
    <p class="login-box-msg">Escribe tus datos para iniciar</p>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="row">

        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>

      </div>


<?php

$login = new ControllerUsuarios();
$login -> ctrIngresoUsuario();

?>


    </form>

  </div>

</div>

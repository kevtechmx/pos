<header class="main-header">

    <!--Logo-->

    <a href="" class="logo">

        <!--Logo_Mini-->
        <span class="logo-mini">

            <img src="views/img/template/logo_mini_2.png" alt="logo_mini" class="img-responsive" style="padding:5px; margin-top: 15px">

        </span>

        <!--Logo_Full-->
        <span class="logo-lg">

            <img src="views/img/template/logo_big.png" alt="logo_big" class="img-responsive" style="padding:10px 0px">

        </span>
    </a>
    <!--Barra de Navegacion-->

    <nav class="navbar navbar-static-top" role="navigation">
        <!--Boton de Navegacion-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <!-- Perfil -->

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">

                        <?php 

                        if($_SESSION["imagen"] != ""){

                            echo '<img src="'.$_SESSION["imagen"].'" alt="imagen_usuario" class="user-image">';

                        }else{
                            echo '<img src="views/img/usuarios/default_user.png" alt="imagen_usuario" class="user-image">';
                        }


                        ?>

                        <span class="hidden-xs">
                            <?php echo $_SESSION["nombre"]; ?></span>
                    </a>

                    <!-- Dropdown Toggle -->
                    <ul class="dropdown-menu">
                        <li class="user-header">

                                <?php 

                                if($_SESSION["imagen"] != ""){
        
                                    echo '<img src="'.$_SESSION["imagen"].'" alt="imagen_usuario"  class="img-circle" alt="User Image">';
        
                                }else{
                                    echo '<img src="views/img/usuarios/default_user.png" alt="imagen_usuario"  class="img-circle" alt="User Image">';
                                }
        
        
                                ?>                            
            
                            <p>
                                    <?php echo $_SESSION["nombre"]; ?>
                              <small><?php echo $_SESSION["perfil"]; ?></small>
                            </p>
                          </li>
                        <!--<li class="user-body">
                            <div>
                                <span>Datos</span>
                                <br>
                                <span>Datos prueba 2</span>
                            </div>
                        </li>-->
                        <li class="user-footer">

                            <div class="pull-right">
                                <a href="salir" class="btn btn-default btn-flat">Cerrar Sesion</a>
                            </div>

                        </li>
                    </ul>

                </li>
            </ul>

        </div>


    </nav>


</header>
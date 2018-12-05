<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventory System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="shortcut icon" href="views/img/template/logo_mini.png" type="image/x-icon">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/AdminLTE.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/KevTechSystem.css">

    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="views/plugins/iCheck/all.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- javascript -->
    <!-- jQuery 3 -->
    <script src="views/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- SlimScroll -->
    <script src="views/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <!-- FastClick -->
    <script src="views/bower_components/fastclick/lib/fastclick.js"></script>

    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="views/dist/js/demo.js"></script>

    <!-- DataTables -->
    <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

    <!--Sweet Alert-->
    <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="views/plugins/iCheck/icheck.min.js"></script>

</head>

<body class="hold-transition skin-black sidebar-collapse sidebar-mini login-page">

    <?php
if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

    /* =============================================== */
    echo '<div class="wrapper">';

    /* Header */
    include "modules/header.php";
    /* Menu */
    include "modules/menu.php";
    /* Contenido */

    if (isset($_GET["ruta"])) {

        if ($_GET["ruta"] == "inicio" ||
                $_GET["ruta"] == "usuarios" ||
                $_GET["ruta"] == "categorias" ||
                $_GET["ruta"] == "productos" ||
                $_GET["ruta"] == "clientes" ||
                $_GET["ruta"] == "ventas" ||
                $_GET["ruta"] == "crear-venta" ||
                $_GET["ruta"] == "salir" ||
                $_GET["ruta"] == "reportes") {

            include "modules/" . $_GET["ruta"] . ".php";
        } else {

            include "modules/404.php";
        }
    } else {

        include "modules/inicio.php";
    }

    /* Contenido */
    include "modules/footer.php";

    echo '</div>';
    /* =============================================== */
} else {
    include "modules/login.php";
}
?>

    <!-- =============================================== -->


    <!-- =============================================== -->


    <script src="views/js/template.js"></script>
    <script src="views/js/usuarios.js"></script>
    <script src="views/js/categorias.js"></script>
    <script src="views/js/productos.js"></script>    
</body>

</html>
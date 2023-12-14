<?php
session_start();
include("../include/conexion.php");
include("../include/busquedas.php");
include("../include/funciones.php");

include("include/verificar_sesion.php");

$cargo = verificar_sesion($conexion);
if ($cargo != "Secretario Academico") {
    echo "<script>
					alert('Error, Usted no cuenta con los permisos para acceder a esta página');
					window.history.back();
				</script>
			";
} else {
    $b_sesion = buscar_sesion_porID($conexion, $_SESSION['id_sesion_sie']);
    $r_b_sesion = mysqli_fetch_array($b_sesion);
    $id_trabajador = $r_b_sesion['id_trabajador'];
    $b_docente = buscar_docentePorId($conexion, $id_trabajador);
    $r_b_docente = mysqli_fetch_array($b_docente);

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reportes Académicos | </title>

        <!-- Bootstrap -->
        <link href="../plantilla/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../plantilla/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../plantilla/vendors/nprogress/nprogress.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../plantilla/build/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">


                        <?php include("include/menu_secretaria_academica.php"); ?>

                        <!-- page content -->
                        <div class="right_col" role="main">
                            <div class="">
                                <div class="page-title">
                                    <div class="title_left">
                                        <h3>REPORTES ACADÉMICOS</h3>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row top_tiles">
                                    <a href="boletas_notas.php">
                                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="tile-stats">
                                                <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                                                <div class="count">2023</div>
                                                <h3>Boletas de Notas</h3>
                                                <p>Boletas de Notas por Aula</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-comments-o"></i></div>
                                            <div class="count">2023</div>
                                            <h3>Primeros Puestos</h3>
                                            <p>Reporte de Primeros Puestos</p>
                                        </div>
                                    </div>
                                    <!--<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                                            <div class="count">179</div>
                                            <h3>New Sign ups</h3>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                        </div>
                                    </div>
                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-check-square-o"></i></div>
                                            <div class="count">179</div>
                                            <h3>New Sign ups</h3>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                        <!-- /page content -->

                        <!-- footer content -->
                        <footer>
                            <div class="pull-right">
                                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                            </div>
                            <div class="clearfix"></div>
                        </footer>
                        <!-- /footer content -->
                    </div>
                </div>

                <!-- jQuery -->
                <script src="../plantilla/vendors/jquery/dist/jquery.min.js"></script>
                <!-- Bootstrap -->
                <script src="../plantilla/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                <!-- FastClick -->
                <script src="../plantilla/vendors/fastclick/lib/fastclick.js"></script>
                <!-- NProgress -->
                <script src="../plantilla/vendors/nprogress/nprogress.js"></script>
                <!-- validator -->
                <script src="../plantilla/vendors/validator/validator.js"></script>

                <!-- Custom Theme Scripts -->
                <script src="../plantilla/build/js/custom.min.js"></script>

    </body>

    </html>
<?php
}

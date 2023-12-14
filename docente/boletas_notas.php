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

        <title>Boletas de Notas | </title>

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
                                        <h3>BUSCAR BOLETA DE NOTAS</h3>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <form action="imprimir_boleta_notas.php" method="POST">
                                        <div class="col-md-6 form-group">
                                            <label class="col-md-12 control-label ">Nivel:</label>
                                            <select name="nivel" id="nivel" class="form-control col-12">
                                                <option value="Todos">Todos</option>
                                                <?php
                                                $b_niveles = buscar_nivel($conexion);
                                                while ($rb_niveles = mysqli_fetch_array($b_niveles)) {
                                                    echo '<option value="' . $rb_niveles['id'] . '">' . $rb_niveles['nombre'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="col-md-12 control-label ">Grado:</label>
                                            <select name="grado" id="grado" class="form-control col-12">
                                                <option value="Todos">Todos</option>
                                                <?php
                                                $b_ciclos = buscar_ciclosPorIdNivel($conexion, $id_nivel);
                                                while ($rb_ciclos = mysqli_fetch_array($b_ciclos)) {
                                                    $b_grados = buscar_gradoPorIdCiclo($conexion, $rb_ciclos['id']);
                                                    while ($rb_grados = mysqli_fetch_array($b_grados)) {
                                                        echo '<option value="' . $rb_grados['id'] . '">' . $rb_grados['nombre'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="col-md-12 control-label ">Turno:</label>
                                            <select name="turno" id="turno" class="form-control col-12">
                                                <option value="Todos">Todos</option>
                                                <?php
                                                $b_turnos = buscar_turno($conexion);
                                                while ($rb_turnos = mysqli_fetch_array($b_turnos)) {
                                                    echo '<option value="' . $rb_turnos['id'] . '">' . $rb_turnos['nombre'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="col-md-12 control-label ">Sección:</label>
                                            <select name="seccion" id="seccion" class="form-control col-12">
                                                <option value="Todos">Todos</option>
                                                <?php
                                                $b_secciones = buscar_seccion($conexion);
                                                while ($rb_secciones = mysqli_fetch_array($b_secciones)) {
                                                    echo '<option value="' . $rb_secciones['id'] . '">' . $rb_secciones['nombre'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-info">Buscar</button>
                                        </div>
                                    </form>
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

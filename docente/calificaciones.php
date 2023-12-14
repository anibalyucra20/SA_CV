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
    $id_curso_programado = $_GET['data'];

    $b_curso_prog = buscar_cursos_prog_porId($conexion, $id_curso_programado);
    $rb_curso_prog = mysqli_fetch_array($b_curso_prog);

    $b_curso = buscar_cursoPorId($conexion, $rb_curso_prog['id_curso']);
    $rb_curso = mysqli_fetch_array($b_curso);

    $b_detmatriculas = buscar_detmatriculadosPorIdCursoProg($conexion, $id_curso_programado);
    $rb_detmatriculas = mysqli_fetch_array($b_detmatriculas);
    $id_det_mat = $rb_detmatriculas['id'];

    $b_calificacion = buscar_calificacionPorIdDetMat($conexion, $id_det_mat);
    $cant_calif = mysqli_num_rows($b_calificacion);
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calificaciones | SIE</title>
        <!--icono en el titulo-->
        <link rel="shortcut icon" href="">

        <!-- Bootstrap -->
        <link href="../plantilla/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../plantilla/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../plantilla/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../plantilla/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="../plantilla/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../plantilla/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../plantilla/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../plantilla/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../plantilla/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="">
                                                <h2 align="center">Calificiaciones - <?php echo $rb_curso['nombre']; ?></h2>
                                                <a href="calificaciones_areas.php" class="btn btn-danger">Regresar</a>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <br />
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2" class="text-center">Nro</th>
                                                                <th rowspan="2" class="text-center">DNI</th>
                                                                <th rowspan="2" class="text-center">APELLIDOS Y NOMBRES</th>
                                                                <th colspan="<?php echo $cant_calif; ?>" class="text-center">CALIFICACIONES</th>
                                                                <th rowspan="2" class="text-center">RECUPERACION</th>
                                                                <th rowspan="2" class="text-center">PROMEDIO FINAL</th>
                                                            </tr>
                                                            <tr>
                                                                <?php
                                                                while ($mostrar_calif = mysqli_fetch_array($b_calificacion)) {
                                                                ?>
                                                                    <th class="text-center"><?php echo $mostrar_calif['detalle']; ?> <a href="evaluacion.php?data=<?php echo $mostrar_calif['id'];  ?>" class="btn btn-primary">Evaluar</a> </th>
                                                                <?php } ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            // buscamos los matriculados a esta area
                                                            $cont_estudiantes = 0;
                                                            $b_detmatriculas = buscar_detmatriculadosPorIdCursoProg($conexion, $id_curso_programado);
                                                            while ($rb_det_mat = mysqli_fetch_array($b_detmatriculas)) {
                                                                $id_det_matricula = $rb_det_mat['id'];
                                                                $cont_estudiantes++;
                                                                //buscar matricula de estudiante
                                                                $b_matricula = buscar_matriculasPorId($conexion, $rb_det_mat['id_matricula']);
                                                                $rb_matricula = mysqli_fetch_array($b_matricula);

                                                                $b_estudiante = buscar_estudiantePorId($conexion, $rb_matricula['id_estudiante']);
                                                                $rb_estudiante = mysqli_fetch_array($b_estudiante);
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $cont_estudiantes; ?></td>
                                                                    <td><?php echo $rb_estudiante['dni']; ?></td>
                                                                    <td><?php echo $rb_estudiante['apellidos_nombres']; ?></td>

                                                                    <?php
                                                                    $b_calificcaciones = buscar_calificacionPorIdDetMat($conexion, $id_det_matricula);
                                                                    $suma_total_calificaciones = 0;
                                                                    $cont_calif = 0;
                                                                    while ($rb_calificacion = mysqli_fetch_array($b_calificcaciones)) {
                                                                        $id_calif = $rb_calificacion['id'];
                                                                    ?>
                                                                        <td class="text-center">
                                                                            <?php
                                                                            $b_evaluacion = buscar_EvaluacionPorIdCalificacion($conexion, $id_calif);
                                                                            $suma_total_evaluacion = calcular_calificacion($conexion, $id_calif);
                                                                            if ($suma_total_evaluacion > 0) {
                                                                                echo convertir_vigesimal_cualitativo(round($suma_total_evaluacion));
                                                                                $suma_total_calificaciones += $suma_total_evaluacion;
                                                                                $cont_calif++;
                                                                            }

                                                                            ?>
                                                                        </td>
                                                                    <?php } ?>
                                                                    <td class="text-center form-control">
                                                                        <select name="recuperacion" id="">
                                                                            <option value=""></option>
                                                                            <option value="AD">AD</option>
                                                                            <option value="A">A</option>
                                                                            <option value="B">B</option>
                                                                            <option value="C">C</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php
                                                                        $promedio_final = round($suma_total_calificaciones / $cont_calif);
                                                                        echo convertir_vigesimal_cualitativo($promedio_final);
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                <!-- iCheck -->
                <script src="../plantilla/vendors/iCheck/icheck.min.js"></script>
                <!-- Datatables -->
                <script src="../plantilla/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
                <script src="../plantilla/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
                <script src="../plantilla/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
                <script src="../plantilla/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
                <script src="../plantilla/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
                <script src="../plantilla/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
                <script src="../plantilla/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
                <script src="../plantilla/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
                <script src="../plantilla/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
                <script src="../plantilla/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
                <script src="../plantilla/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
                <script src="../plantilla/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
                <script src="../plantilla/vendors/jszip/dist/jszip.min.js"></script>
                <script src="../plantilla/vendors/pdfmake/build/pdfmake.min.js"></script>
                <script src="../plantilla/vendors/pdfmake/build/vfs_fonts.js"></script>

                <!-- Custom Theme Scripts -->
                <script src="../plantilla/build/js/custom.min.js"></script>

                <script>
                    $(document).ready(function() {
                        $('#example').DataTable({
                            "language": {
                                "processing": "Procesando...",
                                "lengthMenu": "Mostrar _MENU_ registros",
                                "zeroRecords": "No se encontraron resultados",
                                "emptyTable": "Ningún dato disponible en esta tabla",
                                "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
                                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                "search": "Buscar:",
                                "infoThousands": ",",
                                "loadingRecords": "Cargando...",
                                "paginate": {
                                    "first": "Primero",
                                    "last": "Último",
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                },
                            }
                        });

                    });
                </script>

    </body>

    </html>
<?php }

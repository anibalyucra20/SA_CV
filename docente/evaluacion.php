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
    $id_calificacion = $_GET['data'];



    $b_calificacion = buscar_calificacionPorId($conexion, $id_calificacion);
    $rb_calificacion = mysqli_fetch_array($b_calificacion);
    $orden_calif = $rb_calificacion['orden'];

    $b_det_mat = buscar_detmatriculadosPorId($conexion, $rb_calificacion['id_detalle_maticula']);
    $rb_det_mat = mysqli_fetch_array($b_det_mat);

    $id_curso_programado = $rb_det_mat['id_curso_programado'];



    $b_evaluacion = buscar_EvaluacionPorIdCalificacion($conexion, $id_calificacion);
    $total_evas = mysqli_num_rows($b_evaluacion);
    $cant_eva = 0;
    while ($r_cont = mysqli_fetch_array($b_evaluacion)) {
        $cant_eva++;
        $b_crit_eva = buscar_CritEvaPorIdEvaluacion($conexion, $r_cont['id']);
        $cant_eva += mysqli_num_rows($b_crit_eva);
    }


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

        <!-- Script obtenido desde CDN jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <style>
            p.verticalll {
                /* idéntico a rotateZ(45deg); */

                writing-mode: vertical-lr;
                transform: rotate(180deg);


            }

            .nota_input {
                width: 3em;
            }
        </style>

        <script>
            function confirmar_agregar() {
                var r = confirm("Estas Seguro de Agregar nuevos Criterios de Evaluación?");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
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

                                                <h2 align="center">Evaluaciones - <?php echo $rb_calificacion['detalle']; ?></h2>
                                                <a href="calificaciones.php?data=<?php echo $id_curso_programado; ?>" class="btn btn-danger">Regresar</a>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <br />
                                                <div class="table-responsive">
                                                    <form role="form" action="operaciones/actualizar_criterios_evaluacion.php" method="POST">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="3" class="text-center">Nro</th>
                                                                    <th rowspan="3" class="text-center">DNI</th>
                                                                    <th rowspan="3" class="text-center">APELLIDOS Y NOMBRES</th>
                                                                    <th colspan="<?php echo $cant_eva; ?>" class="text-center">EVALUACIÓN</th>
                                                                    <th rowspan="3" class="text-center">
                                                                        <p class="verticalll">PROMEDIO</p>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    $cont = 0;
                                                                    $b_evaluacion = buscar_EvaluacionPorIdCalificacion($conexion, $id_calificacion);
                                                                    while ($mostrar_eva = mysqli_fetch_array($b_evaluacion)) {
                                                                        $cont++;
                                                                        $b_crit_eva = buscar_CritEvaPorIdEvaluacion($conexion, $mostrar_eva['id']);
                                                                        $cant_crit_Eva = mysqli_num_rows($b_crit_eva);
                                                                        $cant_crit_Eva++;
                                                                    ?>
                                                                        <th colspan="<?php echo $cant_crit_Eva; ?>" class="text-center" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $mostrar_eva['detalle']; ?>">
                                                                            Competencia <?php echo $cont . "<br>ponderado: " . $mostrar_eva['ponderado'] . "%<br>"; ?>
                                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".edit_eva<?php echo $mostrar_eva['id']; ?>"><i class="fa fa-edit"></i></button>
                                                                            <a title="Agregar Criterio de Evaluación" class="btn btn-success" href="operaciones/agregar_criterio_evaluacion.php?data=<?php echo $id_curso_programado; ?>&data2=<?php echo $rb_calificacion['orden']; ?>&data3=<?php echo $mostrar_eva['detalle']; ?>&data4=<?php echo $id_calificacion; ?>" onclick="return confirmar_agregar();"><i class="fa fa-plus-square"></i></a>
                                                                        </th>

                                                                    <?php
                                                                        include('include/acciones_evaluacion.php');
                                                                    } ?>
                                                                </tr>
                                                                <tr>
                                                                    <?php
                                                                    $cont = 0;
                                                                    $b_evaluacion = buscar_EvaluacionPorIdCalificacion($conexion, $id_calificacion);
                                                                    while ($mostrar_eva = mysqli_fetch_array($b_evaluacion)) {
                                                                        $cont++;
                                                                        $b_crit_eva = buscar_CritEvaPorIdEvaluacion($conexion, $mostrar_eva['id']);
                                                                        while ($rb_crit_eva = mysqli_fetch_array($b_crit_eva)) { ?>
                                                                            <th class="text-center">
                                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".edit_crit_eva<?php echo $rb_crit_eva['id']; ?>"><i class="fa fa-edit"></i></button>
                                                                                <p class="verticalll"><?php echo $rb_crit_eva['detalle']; ?></p>
                                                                            </th>
                                                                        <?php
                                                                            include('include/acciones_criterio_evaluacion.php');
                                                                        } ?>
                                                                        <th class="text-center">
                                                                            <p class="verticalll">Promedio</p>
                                                                        </th>
                                                                    <?php } ?>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <input type="hidden" name="data_id" id="data_id" value="<?php echo $id_calificacion; ?>">

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
                                                                        <td class="text-center"><?php echo $rb_estudiante['dni']; ?></td>
                                                                        <td><?php echo $rb_estudiante['apellidos_nombres']; ?></td>
                                                                        <?php
                                                                        $b_calificacion = buscar_calificacionPorIdDetMatOrden($conexion, $id_det_matricula, $orden_calif);
                                                                        while ($rb_calificacion = mysqli_fetch_array($b_calificacion)) {
                                                                            $id_calificacion = $rb_calificacion['id'];

                                                                            $b_evaluacion = buscar_EvaluacionPorIdCalificacion($conexion, $id_calificacion);
                                                                            $suma_total_evaluacion = 0;
                                                                            while ($rb_evaluacion = mysqli_fetch_array($b_evaluacion)) {
                                                                                $id_evaluacion = $rb_evaluacion['id'];

                                                                                $b_ind_logro = buscar_CritEvaPorIdEvaluacion($conexion, $id_evaluacion);
                                                                                $cant_crit_eva = 0;
                                                                                $suma_total_crit_eva = 0;
                                                                                while ($rb_ind_logro = mysqli_fetch_array($b_ind_logro)) {
                                                                                    if ($rb_ind_logro['calificacion'] != "") {
                                                                                        $cant_crit_eva++;
                                                                                        $suma_total_crit_eva += $rb_ind_logro['calificacion'];
                                                                                    }
                                                                        ?>
                                                                                    <td class="text-center" height="auto" width="20px"><input type="number" name="<?php echo $rb_estudiante['dni'] . "_" . $rb_ind_logro['id']; ?>" class="nota_input" value="<?php echo $rb_ind_logro['calificacion']; ?>" max="20" min="0"></td>
                                                                                <?php }
                                                                                if ($suma_total_crit_eva > 0) {
                                                                                    $suma_total_evaluacion += ($rb_evaluacion['ponderado'] / 100) * round($suma_total_crit_eva / $cant_crit_eva);
                                                                                }
                                                                                ?>
                                                                                <td class="text-center" height="auto" width="20px"><?php if ($suma_total_crit_eva > 0) {
                                                                                                                                        echo round($suma_total_crit_eva / $cant_crit_eva);
                                                                                                                                    } ?></td>
                                                                            <?php } ?>
                                                                            <td class="text-center" height="auto" width="20px">
                                                                                <?php
                                                                                if ($suma_total_evaluacion > 0) {
                                                                                    echo convertir_vigesimal_cualitativo(round($suma_total_evaluacion));
                                                                                } else {
                                                                                    echo "";
                                                                                }

                                                                                ?>
                                                                            </td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                        <center>
                                                            <button type="submit" class="btn btn-success">Guardar</button>
                                                        </center>
                                                    </form>
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

                <script type="text/javascript">
                    function actualizarCritEvaluacion(id, id_eva, id_calif, orden, detalle_eva) {
                        let detalle_crit_eva = document.getElementById("detalle_crit_eva_" + id).value
                        window.location = 'operaciones/actualizar_dato_criterio_evaluacion.php?id=' + id + '&detalle=' + detalle_crit_eva + '&id_eva=' + id_eva + '&id_calif=' + id_calif + '&orden=' + orden;
                    };
                </script>
                <script>
                    function actualizarEvaluacion(id, id_calif) {
                        let ponderado = document.getElementById("peso_evav_" + id).value
                        window.location = 'operaciones/actualizar_dato_evaluacion.php?id=' + id + '&peso=' + ponderado + '&id_calif=' + id_calif;
                    };
                </script>

    </body>

    </html>
<?php }

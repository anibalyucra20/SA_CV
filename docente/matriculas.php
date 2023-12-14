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

    $id_competencia = $_GET['competencia'];
    $b_competencia = buscar_competenciaPorId($conexion, $id_competencia);
    $r_b_competencia = mysqli_fetch_array($b_competencia);

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Matrícula | SIE</title>
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
                                            <div class="x_title">
                                                <h2>Matrículas</h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <a href="matricula.php" class="btn btn-success"><i class="fa fa-plus-square"></i> Nuevo</a>
                                                <div class="clearfix"></div>
                                                <br />
                                                <div class="x_content">
                                                    <div class="row" class="col-12">
                                                        <form action="">
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
                                                <br>
                                                <br>
                                                <div class="x_content">
                                                    <table id="example" class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Nro</th>
                                                                <th>DNI</th>
                                                                <th>Estudiante</th>
                                                                <th>Año Académico</th>
                                                                <th>Sede</th>
                                                                <th>Nivel</th>
                                                                <th>Grado</th>
                                                                <th>Turno</th>
                                                                <th>Sección</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $cont = 0;
                                                            $b_matriculas = buscar_matriculasPorAnioAcademicoSede($conexion, $_SESSION['anio_lectivo'], $_SESSION['id_sede']);
                                                            while ($rb_matriculas = mysqli_fetch_array($b_matriculas)) {
                                                                $cont++;

                                                                $b_estudiante = buscar_estudiantePorId($conexion, $rb_matriculas['id_estudiante']);
                                                                $rb_estudiante = mysqli_fetch_array($b_estudiante);

                                                                $b_anio_acad = buscar_anio_academico_id($conexion, $_SESSION['anio_lectivo']);
                                                                $rb_anio_acad = mysqli_fetch_array($b_anio_acad);

                                                                $b_sede = buscar_sedesPorId($conexion, $_SESSION['id_sede']);
                                                                $rb_sede = mysqli_fetch_array($b_sede);

                                                                $b_nivel = buscar_nivel_id($conexion, $rb_matriculas['id_nivel']);
                                                                $rb_nivel = mysqli_fetch_array($b_nivel);

                                                                $b_grado = buscar_gradoPorId($conexion, $rb_matriculas['id_grado']);
                                                                $rb_grado = mysqli_fetch_array($b_grado);

                                                                $b_turno = buscar_turno_id($conexion, $rb_matriculas['id_turno']);
                                                                $rb_turno = mysqli_fetch_array($b_turno);

                                                                $b_seccion = buscar_seccionPorid($conexion, $rb_matriculas['id_seccion']);
                                                                $rb_seccion = mysqli_fetch_array($b_seccion);
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $cont; ?></td>
                                                                    <td><?php echo $rb_estudiante['dni']; ?></td>
                                                                    <td><?php echo $rb_estudiante['apellidos_nombres']; ?></td>
                                                                    <td><?php echo $rb_anio_acad['nombre']; ?></td>
                                                                    <td><?php echo $rb_sede['nombre']; ?></td>
                                                                    <td><?php echo $rb_nivel['nombre']; ?></td>
                                                                    <td><?php echo $rb_grado['nombre']; ?></td>
                                                                    <td><?php echo $rb_turno['nombre']; ?></td>
                                                                    <td><?php echo $rb_seccion['nombre']; ?></td>
                                                                    <td><button type="button" class="btn btn-success" data-toggle="modal" data-target=".editar<?php echo $i; ?>">Editar</button><button class="btn btn-danger">Eliminar</button></td>
                                                                </tr>
                                                                <!--MODAL EDITAR-->
                                                                <div class="modal fade editar<?php echo $i; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">

                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                                </button>
                                                                                <h4 class="modal-title" id="myModalLabel" align="center">Registrar Periodo Léctivo</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <!--INICIO CONTENIDO DE MODAL-->
                                                                                <div class="x_panel">

                                                                                    <div class="" align="center">
                                                                                        <h2></h2>
                                                                                        <div class="clearfix"></div>
                                                                                    </div>
                                                                                    <div class="x_content">
                                                                                        <br />
                                                                                        <form role="form" action="operaciones/registrar_periodo_lectivo.php" class="form-horizontal form-label-left input_mask" method="POST">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre : </label>
                                                                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                                                                        <input type="text" maxlength="20" class="form-control">
                                                                                                        <br>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Inicio : </label>
                                                                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                                                                        <input type="date" class="form-control" name="fecha_inicio" required="required">
                                                                                                        <br>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Fin : </label>
                                                                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                                                                        <input type="date" class="form-control" name="fecha_fin" required="required">
                                                                                                        <br>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div align="center">
                                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                                <!--FIN DE CONTENIDO DE MODAL-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- FIN MODAL EDITAR-->
                                                            <?php
                                                            }
                                                            ?>
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

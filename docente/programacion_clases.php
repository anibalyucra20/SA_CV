<?php
session_start();
include("../include/conexion.php");
include("../include/busquedas.php");
include("../include/funciones.php");

include("include/verificar_sesion.php");

$cargo = verificar_sesion($conexion);
if($cargo!="Secretario Academico"){
    echo "<script>
					alert('Error, Usted no cuenta con los permisos para acceder a esta página');
					window.history.back();
				</script>
			";
}else{

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Programación de Clases | SIE</title>
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
                                            <h2>Programación de Clases</h2>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target=".registrar"><i class="fa fa-plus-square"></i> Nuevo</button>


                                            <!--MODAL REGISTRAR-->
                                            <div class="modal fade registrar" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel" align="center">Registrar Programación de Clases</h4>
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
                                                                    <form role="form" action="operaciones/registrar_programacion_clases.php" class="form-horizontal form-label-left input_mask" method="POST">

                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nivel : </label>
                                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                                <select name="nivel" id="nivel_m" class="form-control">
                                                                                    <option value=""></option>
                                                                                    <?php $b_nivel = buscar_nivel($conexion);
                                                                                    while ($r_b_nivel = mysqli_fetch_array($b_nivel)) { ?>
                                                                                        <option value="<?php echo $r_b_nivel['id']; ?>"><?php echo $r_b_nivel['nombre']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Grados : </label>
                                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                                <select name="grado" id="grado_m" class="form-control">
                                                                                    <option value=""></option>

                                                                                </select>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            
                                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Curso : </label>
                                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                                <select name="cursos" id="curso_m" class="form-control">
                                                                                    <option value=""></option>

                                                                                </select>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sección : </label>
                                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                                <select name="seccion" id="seccion" class="form-control">
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                        $b_seccion = buscar_seccion($conexion);
                                                                                        while ($r_b_seccion = mysqli_fetch_array($b_seccion)) { ?>
                                                                                            <option value="<?php echo $r_b_seccion['id']; ?>"><?php echo $r_b_seccion['nombre']; ?></option>
                                                                                       <?php }
                                                                                    ?>
                                                                                </select>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Turno : </label>
                                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                                <select name="turno" id="turno" class="form-control">
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                        $b_turno = buscar_turno($conexion);
                                                                                        while ($r_b_turno= mysqli_fetch_array($b_turno)) { ?>
                                                                                            <option value="<?php echo $r_b_turno['id']; ?>"><?php echo $r_b_turno['nombre']; ?></option>
                                                                                       <?php }
                                                                                    ?>
                                                                                </select>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Modalidad : </label>
                                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                                <select name="modalidad" id="modalidad" class="form-control">
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                        $b_modalidad= buscar_modalidad($conexion);
                                                                                        while ($r_b_modalidad  = mysqli_fetch_array($b_modalidad)) { ?>
                                                                                            <option value="<?php echo $r_b_modalidad['id']; ?>"><?php echo $r_b_modalidad['detalle']; ?></option>
                                                                                       <?php }
                                                                                    ?>
                                                                                </select>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Docente : </label>
                                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                                <select name="docente" id="docente" class="form-control">
                                                                                    <option value=""></option>
                                                                                    <?php
                                                                                        $b_docente = buscar_docenteOrdenAp($conexion);
                                                                                        while ($r_b_docente = mysqli_fetch_array($b_docente)) { 
                                                                                            ?>
                                                                                            <option value="<?php echo $r_b_docente['id']; ?>"><?php echo $r_b_docente['apellidos_nombres']; ?></option>
                                                                                       <?php }
                                                                                    ?>
                                                                                </select>
                                                                                <br>
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

                                            <!-- FIN MODAL REGISTRAR-->
                                            <br />
                                            <div class="x_content">
                                                <table id="example" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Nro</th>
                                                            <th>Año</th>
                                                            <th>Nivel</th>
                                                            <th>Grado</th>
                                                            <th>Seccion</th>
                                                            <th>Turno</th>
                                                            <th>Curso</th>
                                                            <th>Docente</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>
                                                        <?php
                                                        $b_cursos_programados = buscar_cursos_prog_porSede_Anio($conexion, $_SESSION['id_sede'], $_SESSION['anio_lectivo']);
                                                        $cont = 0;
                                                        while($rb_cursos_programados = mysqli_fetch_array($b_cursos_programados)){
                                                        $cont++;
                                                        //buscar anio
                                                        $b_anio = buscar_anio_academico_id($conexion, $rb_cursos_programados['id_anio_academico']);
                                                        $rb_anio = mysqli_fetch_array($b_anio);

                                                        //buscar sede
                                                        $b_sede = buscar_sedesPorId($conexion, $rb_cursos_programados['id_sede']);
                                                        $rb_sede = mysqli_fetch_array($b_sede);

                                                        //buscar seccion
                                                        $b_seccion = buscar_seccionPorid($conexion, $rb_cursos_programados['id_seccion']);
                                                        $rb_seccion = mysqli_fetch_array($b_seccion);

                                                        //buscar turno
                                                        $b_turno = buscar_turno_id($conexion, $rb_cursos_programados['id_turno']);
                                                        $rb_turno = mysqli_fetch_array($b_turno);

                                                        // buscar curso
                                                        $b_curso = buscar_cursoPorId($conexion, $rb_cursos_programados['id_curso']);
                                                        $rb_curso = mysqli_fetch_array($b_curso);

                                                        // buscar grado
                                                        $b_grado = buscar_gradoPorId($conexion, $rb_curso['id_grado']);
                                                        $rb_grado = mysqli_fetch_array($b_grado);
                                                         // buscar ciclo
                                                         $b_ciclo = buscar_ciclosPorId($conexion, $rb_grado['id_ciclo']);
                                                         $rb_ciclo = mysqli_fetch_array($b_ciclo);

                                                        //buscar nivel
                                                        $b_nivel = buscar_nivel_id($conexion, $rb_ciclo['id_nivel']);
                                                        $rb_nivel = mysqli_fetch_array($b_nivel);

                                                        //buscar docente
                                                        $b_docente = buscar_docentePorId($conexion, $rb_cursos_programados['id_docente']);
                                                        $rb_docente= mysqli_fetch_array($b_docente);

                                                        ?>
                                                            <tr>
                                                                <td><?php echo $cont; ?></td>
                                                                <td><?php echo $rb_anio['nombre']; ?></td>
                                                                <td><?php echo $rb_nivel['nombre']; ?></td>
                                                                <td><?php echo $rb_grado['nombre']; ?></td>
                                                                <td><?php echo $rb_seccion['nombre']; ?></td>
                                                                <td><?php echo $rb_turno['nombre']; ?></td>
                                                                <td><?php echo $rb_curso['nombre']; ?></td>
                                                                <td><?php echo $rb_docente['apellidos_nombres']; ?></td>
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
            <script type="text/javascript">
                $(document).ready(function() {
                    recargargrado();
                    recargarcursos();
                    $('#nivel_m').change(function() {
                        recargargrado();
                    });
                    $('#grado_m').change(function() {
                        recargarcursos();
                    });


                })
            </script>
            <script type="text/javascript">
                function recargargrado() {
                    $.ajax({
                        type: "POST",
                        url: "operaciones/obtener_grados.php",
                        data: "id_nivel=" + $('#nivel_m').val(),
                        success: function(r) {
                            $('#grado_m').html(r);
                        }
                    });
                }
            </script>
            <script type="text/javascript">
                function recargarcursos() {
                    $.ajax({
                        type: "POST",
                        url: "operaciones/obtener_cursos.php",
                        data: "id_grado=" + $('#grado_m').val(),
                        success: function(r) {
                            $('#curso_m').html(r);
                        }
                    });
                }
            </script>

</body>

</html>

<?php

            }
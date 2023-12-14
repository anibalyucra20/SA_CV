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
    $b_curso = buscar_cursoPorId($conexion, $_GET['data']);
    $r_b_curso = mysqli_fetch_array($b_curso);
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cursos | SIE</title>
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
                                                <h2>Editar Curso</h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <form role="form" action="operaciones/editar_curso.php" class="form-horizontal form-label-left input_mask" method="POST">
                                                    <input type="hidden" name="data" value="<?php echo $r_b_curso['id']; ?>">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Grado : </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <select name="id_grado" id="id_grado" class="form-control">
                                                                <option value=""></option>
                                                                <?php
                                                                $b_grado = buscar_grado($conexion);
                                                                while ($r_b_grado = mysqli_fetch_array($b_grado)) {
                                                                    $b_ciclo = buscar_ciclosPorId($conexion, $r_b_grado['id_ciclo']);
                                                                    $r_b_ciclo = mysqli_fetch_array($b_ciclo);

                                                                    $b_nivel = buscar_nivel_id($conexion, $r_b_ciclo['id_nivel']);
                                                                    $r_b_nivel = mysqli_fetch_array($b_nivel);
                                                                ?>
                                                                    <option value="<?php echo $r_b_grado['id'];  ?>" <?php if ($r_b_curso['id_grado'] == $r_b_grado['id']) {
                                                                                                                            echo "selected";
                                                                                                                        } ?>><?php echo $r_b_grado['nombre'] . " - " . $r_b_nivel['nombre'];  ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Área Curricular : </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <select name="id_area" id="id_area" class="form-control">
                                                                <option value=""></option>
                                                                <?php
                                                                $b_area = buscar_area_curricular($conexion);
                                                                while ($rb_area = mysqli_fetch_array($b_area)) { ?>
                                                                    <option value="<?php echo $rb_area['id']; ?>" <?php if ($rb_area['id'] == $r_b_curso['id_area_curricular']) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>><?php echo $rb_area['nombre']; ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre de Curso : </label>
                                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" maxlength="50" class="form-control" name="editar_curso" value="<?php echo $r_b_curso['nombre']; ?>">
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion de curso : </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <textarea name="descripcion_curso" id="" cols="30" rows="10" class="form-control"><?php echo $r_b_curso['descripcion']; ?>
                                                                                                </textarea>
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
                        $('#grado').change(function() {
                            cargar_areas();
                        });
                    });
                    $(document).ready(function() {
                        $('#id_grado').change(function() {
                            cargar_areas_edit();
                        });
                    })
                </script>
                <script type="text/javascript">
                    function cargar_areas() {
                        $.ajax({
                            type: "POST",
                            url: "operaciones/obtener_areas.php",
                            data: "id=" + $('#grado').val(),
                            success: function(r) {
                                $('#area').html(r);
                            }
                        });
                    };

                    function cargar_areas_edit() {
                        $.ajax({
                            type: "POST",
                            url: "operaciones/obtener_areas.php",
                            data: "id=" + $('#id_grado').val(),
                            success: function(r) {
                                $('#id_area').html(r);
                            }
                        });
                    };
                </script>


    </body>

    </html>

<?php
}

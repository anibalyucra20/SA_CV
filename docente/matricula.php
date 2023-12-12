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
                                    <div class="col-md-6 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>Datos de Matrícula</h2>

                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <br />
                                                <form role="form" id="myform" action="operaciones/registrar_matricula.php" class="form-horizontal form-label-left input_mask" method="POST">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">DNI estudiante: </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <input class="form-control" type="number" name="dni_est" id="dni_est" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <button type="button" class="btn btn-success" onclick="recargarest();">Buscar</button>

                                                            <br>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Estudiante : </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <input type="hidden" id="id_est" name="id_est">
                                                            <input type="hidden" id="id_sede" name="id_sede">
                                                            <input class="form-control" type="text" name="estudiante" id="estudiante" readonly>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sede : </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <select class="form-control" id="sede_m" name="sede_m" value="" required="required">
                                                                <option></option>
                                                                <!-- datos a traer segun los datos del estudiante -->
                                                            </select>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nivel : </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <select class="form-control" id="nivel_m" name="nivel_m" value="" required="required">
                                                                <option></option>
                                                                <!-- datos a traer segun los datos del estudiante -->
                                                            </select>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Grado : </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <select class="form-control" id="grado_m" name="grado_m" value="" required="required">
                                                                <option></option>
                                                                <!-- datos a traer segun los datos del estudiante -->
                                                            </select>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Turno : </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <select class="form-control" id="turno_m" name="turno_m" value="" required="required">
                                                                <option></option>
                                                                <?php
                                                                $b_turnos = buscar_turno($conexion);
                                                                while ($rb_turnos = mysqli_fetch_array($b_turnos)) { ?>
                                                                    <option value="<?php echo $rb_turnos['id']; ?>"><?php echo $rb_turnos['nombre']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sección : </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                                            <select class="form-control" id="seccion_m" name="seccion_m" value="" required="required">
                                                                <option></option>
                                                                <?php
                                                                $b_seccion = buscar_seccion($conexion);
                                                                while ($rb_seccion = mysqli_fetch_array($b_seccion)) { ?>
                                                                    <option value="<?php echo $rb_seccion['id']; ?>"><?php echo $rb_seccion['nombre']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    



                                                    <div align="center">
                                                        <a href="matriculas.php" class="btn btn-default">Cancelar</a>
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>Unidades Didácticas para Matricula</h2>

                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                            <div class="form-group">
                                                        <input type="hidden" id="arr_uds" name="arr_uds">
                                                        <input type="hidden" id="mat_relacion" name="mat_relacion" required>
                                                        </label>
                                                        <div class="col-md-9 col-sm-9 col-xs-12" id="udss">
                                                            <div class="checkbox">
                                                                
                                                            </div>

                                                        </div>
                                                    </div>
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

            <script type="text/javascript">
                $(document).ready(function() {

                    $('#nivel_m').change(function() {
                        listar_grados();
                    });
                    $('#grado_m').change(function() {
                        listar_cursos();
                    });
                    $('#turno_m').change(function() {
                        listar_cursos();
                    });
                    $('#seccion_m').change(function() {
                        listar_cursos();
                    });

                })
            </script>
            <script type="text/javascript">
                function recargarest() {
                    // funcion para traer datos del estudiante
                    // Creando el objeto para hacer el request
                    var request = new XMLHttpRequest();
                    request.responseType = 'json';
                    // Objeto PHP que consultaremos
                    request.open("POST", "operaciones/obtener_estudiante.php");
                    // Definiendo el listener
                    request.onreadystatechange = function() {
                        // Revision si fue completada la peticion y si fue exitosa
                        if (this.readyState === 4 && this.status === 200) {
                            // Ingresando la respuesta obtenida del PHP
                            document.getElementById("id_est").value = this.response.id_est;
                            document.getElementById("estudiante").value = this.response.nombre;
                            document.getElementById("id_sede").value = this.response.sede;
                            cargar_sede();

                        }
                    };
                    // Recogiendo la data del HTML
                    var myForm = document.getElementById("myform");
                    var formData = new FormData(myForm);
                    // Enviando la data al PHP
                    request.send(formData);
                }
            </script>
            <script type="text/javascript">
                function cargar_sede() {
                    $.ajax({
                        type: "POST",
                        url: "operaciones/obtener_sedes.php",
                        data: "id=" + $('#id_sede').val(),
                        success: function(r) {
                            $('#sede_m').html(r);
                            listar_niveles();

                        }
                    });
                }
            </script>
            <script type="text/javascript">
                function listar_niveles() {
                    $.ajax({
                        type: "POST",
                        url: "operaciones/obtener_niveles.php",
                        data: "id=" + $('#id_sede').val(),
                        success: function(r) {
                            $('#nivel_m').html(r);

                        }
                    });
                }
            </script>
            <script type="text/javascript">
                function listar_grados() {
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
                function listar_cursos() {
                    var sede = $('#sede_m').val();
                    var grado = $('#grado_m').val();
                    var turno = $('#turno_m').val();
                    var seccion = $('#seccion_m').val();
                    $.ajax({
                        type: "POST",
                        url: "operaciones/cargar_cursos_check.php",
                        data: {id_sede: sede,id_grado: grado, id_turno: turno,id_seccion: seccion },
                        success: function(r) {
                            $('#udss').html(r);
                        }
                    });
                }
            </script>

    </body>

    </html>
<?php }

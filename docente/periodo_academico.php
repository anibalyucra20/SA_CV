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

  <title>Periodo Académico | SIE</title>
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
                      <h2>Periodo Académico</h2>
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
                              <h4 class="modal-title" id="myModalLabel" align="center">Registrar Periodo Academico</h4>
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
                                  <form role="form" action="operaciones/registrar_periodo_academico.php" class="form-horizontal form-label-left input_mask" method="POST">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Periodo Académico : </label>
                                      <div class="row">
                                        <div class="col-md-3 col-sm-3 col-xs-6">
                                          <select class="form-control" name="anio" id="anio" required>
                                            <option value=""></option>
                                            <?php
                                            $anio = date("Y");
                                            for ($i = $anio; $i < $anio + 4; $i++) {
                                            ?>
                                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php
                                            }
                                            ?>


                                          </select>
                                          <br>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sede : </label>
                                      <div class="col-md-3 col-sm-3 col-xs-6">
                                        <select class="form-control" id="sede" name="sede" value="" required="required">
                                          <option></option>
                                          <?php
                                          $b_sedes = buscar_sedes($conexion);
                                          while ($r_b_sedes = mysqli_fetch_array($b_sedes)) { ?>
                                            <option value="<?php echo $r_b_sedes['id']; ?>"><?php echo $r_b_sedes['nombre']; ?></option>
                                          <?php } ?>

                                        </select>
                                        <br>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Director : </label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control" id="director" name="director" value="" required="required">
                                          <option></option>
                                          <?php
                                          $b_director = buscar_docentePorCargo($conexion, "Director");
                                          while ($r_b_director = mysqli_fetch_array($b_director)) { ?>
                                            <option value="<?php echo $r_b_director['id']; ?>"><?php echo $r_b_director['apellidos_nombres']; ?></option>
                                          <?php } ?>
                                        </select>
                                        <br>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Secretario Académico : </label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control" id="secretario" name="secretario" value="" required="required">
                                          <option></option>
                                          <?php
                                          $b_secretaria = buscar_docentePorCargo($conexion, "Secretario Academico");
                                          while ($r_b_secretaria = mysqli_fetch_array($b_secretaria)) { ?>
                                            <option value="<?php echo $r_b_secretaria['id']; ?>"><?php echo $r_b_secretaria['apellidos_nombres']; ?></option>
                                          <?php } ?>
                                        </select>
                                        <br>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Inicio : </label>
                                      <div class="col-md-3 col-sm-3 col-xs-6">
                                        <input type="date" class="form-control" name="fecha_inicio" required="required">
                                        <br>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Fin : </label>
                                      <div class="col-md-3 col-sm-3 col-xs-6">
                                        <input type="date" class="form-control" name="fecha_fin" required="required">
                                        <br>
                                      </div>
                                    </div>


                                    <!--
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cursos a Programar :
                                      </label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="checkbox">
                                          <label>
                                            <input type="checkbox" class="flat" name="pe_2"> INICIAL </label>
                                        </div>
                                        <div class="checkbox">
                                          <label>
                                            <input type="checkbox" class="flat" name="pe_3"> PRIMARIA </label>
                                        </div>
                                        <div class="checkbox">
                                          <label>
                                            <input type="checkbox" class="flat" name="pe_4"> SECUNDARIA </label>
                                        </div>

                                        <br><br>
                                      </div>
                                    </div>
                                          -->
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
                              <th>Sede</th>
                              <th>Fecha Inicio</th>
                              <th>Fecha Fin</th>
                              <th>Director</th>
                              <th>Secretario</th>
                              <th>Acciones</th>

                            </tr>
                          </thead>


                          <tbody>
                            <?php
                            $cont = 0;
                            $b_periodo_academicos = buscar_anio_academico($conexion);
                            while ($r_b_periodo_academicos = mysqli_fetch_array($b_periodo_academicos)) {
                              $cont++;


                            ?>
                              <tr>
                                <td><?php echo $cont; ?></td>
                                <td><?php echo $r_b_periodo_academicos['nombre']; ?></td>
                                <?php $b_sedes = buscar_sedesPorId($conexion, $r_b_periodo_academicos['id_sede']);
                                $r_b_sedes = mysqli_fetch_array($b_sedes);
                                ?>
                                <td><?php echo $r_b_sedes['nombre']; ?></td>
                                <td><?php echo $r_b_periodo_academicos['fecha_inicio']; ?></td>
                                <td><?php echo $r_b_periodo_academicos['fecha_fin']; ?></td>
                                <?php $b_director = buscar_docentePorId($conexion, $r_b_periodo_academicos['id_director']);
                                $r_b_director = mysqli_fetch_array($b_director);
                                ?>
                                <td><?php echo $r_b_director['apellidos_nombres']; ?></td>
                                <?php $b_secretario = buscar_docentePorId($conexion, $r_b_periodo_academicos['id_secretario']);
                                $r_b_secretario = mysqli_fetch_array($b_secretario);
                                ?>
                                <td><?php echo $r_b_secretario['apellidos_nombres']; ?></td>
                                <td><button type="button" class="btn btn-success" data-toggle="modal" data-target=".editar<?php echo $r_b_periodo_academicos['id']; ?>">Editar</button></td>
                              </tr>
                              <!--MODAL EDITAR-->
                              <div class="modal fade editar<?php echo $r_b_periodo_academicos['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">

                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel" align="center">Editar Periodo Acádemico</h4>
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
                                          <form role="form" action="operaciones/editar_periodo_academico.php" class="form-horizontal form-label-left input_mask" method="POST">
                                            <input type="hidden" name="data" value="<?php echo $r_b_periodo_academicos['id']; ?>" >
                                            <div class="row">
                                              <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Periodo Académico : </label>

                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                  <select class="form-control" name="editar_anio" id="editar_anio" required value="<?php echo $r_b_periodo_academicos['nombre']; ?>">
                                                    <option value=""></option>
                                                    <?php
                                                    $anio = date("Y");
                                                    for ($i = $anio; $i < $anio + 4; $i++) {
                                                    ?>
                                                      <option value="<?php echo $i; ?>"<?php if($r_b_periodo_academicos['nombre'] == $i){ echo "selected";} ?>><?php echo $i; ?></option>
                                                    <?php
                                                    }
                                                    ?>


                                                  </select>
                                                  <br>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sede : </label>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                  <select class="form-control" id="editar_sede" name="editar_sede" value="<?php echo $r_b_periodo_academicos['id_sede']; ?>" required="required">
                                                    <option></option>
                                                    <?php
                                                    $b_sedes = buscar_sedes($conexion);
                                                    while ($r_b_sedes = mysqli_fetch_array($b_sedes)) { ?>
                                                      <option value="<?php echo $r_b_sedes['id']; ?>"<?php if($r_b_periodo_academicos['id_sede'] == $r_b_sedes['id']){ echo "selected";} ?>><?php echo $r_b_sedes['nombre']; ?></option>
                                                    <?php } ?>

                                                  </select>
                                                  <br>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Director : </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <select class="form-control" id="editar_director" name="editar_director" value="<?php echo $r_b_periodo_academicos['id_director']; ?>" required="required">
                                                    <option></option>
                                                    <?php
                                                    $b_director = buscar_docentePorCargo($conexion, "Director");
                                                    while ($r_b_director = mysqli_fetch_array($b_director)) { ?>
                                                      <option value="<?php echo $r_b_director['id']; ?>" <?php if($r_b_periodo_academicos['id_director'] == $r_b_director['id']){ echo "selected";} ?>><?php echo $r_b_director['apellidos_nombres']; ?></option>
                                                    <?php } ?>
                                                  </select>
                                                  <br>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Secretario Académico : </label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <select class="form-control" id="editar_secretario" name="editar_secretario" value="<?php echo $r_b_periodo_academicos['id_secretario']; ?>" required="required">
                                                    <option></option>
                                                    <?php
                                                    $b_secretario = buscar_docentePorCargo($conexion, "Secretario Academico");
                                                    while ($r_b_secretario = mysqli_fetch_array($b_secretario)) { ?>
                                                      <option value="<?php echo $r_b_secretario['id']; ?>" <?php if($r_b_periodo_academicos['id_secretario'] == $r_b_secretario['id']){ echo "selected";} ?>><?php echo $r_b_secretario['apellidos_nombres']; ?></option>
                                                    <?php } ?>
                                                  </select>
                                                  <br>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="row">
                                              <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Inicio : </label>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                  <input type="date" class="form-control" name="editar_fecha_inicio" required="required" value="<?php echo $r_b_periodo_academicos['fecha_inicio']; ?>">
                                                  <br>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Fin : </label>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                  <input type="date" class="form-control" name="editar_fecha_fin" required="required" value="<?php echo $r_b_periodo_academicos['fecha_fin']; ?>">
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
<?php
}
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

  <title>Docente | SIE</title>
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

<body class="nav-md" onload="desactivar_controles();">
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
                      <h2>Datos Institucionales</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <?php
                      $buscar = buscar_datos_institucionales($conexion);
                      $res = mysqli_fetch_array($buscar);
                      ?>
                      <form role="form" id="myform" action="operaciones/actualizar_datos_institucion.php" class="form-horizontal form-label-left input_mask" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Ruc : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="number" class="form-control" name="ruc" id="ruc" required="" value="<?php echo $res['ruc']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <br>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Código Modular : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="number" class="form-control" name="cod_modular" id="cod_modular" required="" value="<?php echo $res['cod_modular']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <br>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre de Institución : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="razon_social" id="razon_social" required="" value="<?php echo $res['razon_social']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">

                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Departamento : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="dep" id="dep" required="" value="<?php echo $res['departamento']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">

                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Provincia : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="provincia" id="provincia" required="" value="<?php echo $res['provincia']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Distrito : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="distrito" id="distrito" required="" value="<?php echo $res['distrito']; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;">
                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="direccion" id="direccion" required="" value="<?php echo $res['direccion']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="number" class="form-control" name="telefono" id="telefono" required="" value="<?php echo $res['telefono']; ?>">
                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="email" id="email" required="" value="<?php echo $res['correo']; ?>">
                            <br>
                          </div>
                        </div>
                        <div align="center">
                          <button type="submit" class="btn btn-primary" id="btn_guardar">Guardar</button>
                          <button type="button" class="btn btn-warning" id="btn_cancelar" onclick="desactivar_controles(); cancelar();">Cancelar</button>
                        </div>
                    </div>
                    </form>
                    <div align="center">
                      <button type="button" class="btn btn-success" id="btn_editar" onclick="activar_controles();">Editar Datos</button>
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
      function desactivar_controles() {
        document.getElementById('cod_modular').disabled = true
        document.getElementById('ruc').disabled = true
        document.getElementById('razon_social').disabled = true
        document.getElementById('dep').disabled = true
        document.getElementById('provincia').disabled = true
        document.getElementById('distrito').disabled = true
        document.getElementById('direccion').disabled = true
        document.getElementById('telefono').disabled = true
        document.getElementById('email').disabled = true
        document.getElementById('btn_cancelar').style.display = 'none'
        document.getElementById('btn_guardar').style.display = 'none'
        document.getElementById('btn_editar').style.display = ''
      };

      function activar_controles() {
        document.getElementById('cod_modular').disabled = false
        document.getElementById('ruc').disabled = false
        document.getElementById('razon_social').disabled = false
        document.getElementById('dep').disabled = false
        document.getElementById('provincia').disabled = false
        document.getElementById('distrito').disabled = false
        document.getElementById('direccion').disabled = false
        document.getElementById('telefono').disabled = false
        document.getElementById('email').disabled = false
        document.getElementById('btn_cancelar').removeAttribute('style')
        document.getElementById('btn_guardar').removeAttribute('style')
        document.getElementById('btn_editar').style.display = 'none'
      };

      function cancelar() {
        document.getElementById('myform').reset();
      }
    </script>




</body>

</html>
<?php
}
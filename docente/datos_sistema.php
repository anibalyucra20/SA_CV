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

  <title>Datos Sistema | SIE</title>
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
                      <h2>Datos de Sistema</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <?php
                      $buscar = buscar_datos_sistema($conexion);
                      $res = mysqli_fetch_array($buscar);
                      ?>
                      <form role="form" id="myform" action="operaciones/actualizar_datos_sistema.php" class="form-horizontal form-label-left input_mask" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Dominio Página : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="number" class="form-control" name="pagina" id="pagina" required="" value="<?php echo $res['dominio_pagina']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <br>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Dominio de Sistema : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="number" class="form-control" name="sistema" id="sistema" required="" value="<?php echo $res['dominio_sistema']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <br>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">titulo : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="titulo" id="titulo" required="" value="<?php echo $res['titulo']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">

                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Pie de Página : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="pie_pagina" id="pie_pagina" required="" value="<?php echo $res['pie_pagina']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">

                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Host de Correo : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="host_email" id="host_email" required="" value="<?php echo $res['host_email']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo para envío : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="email_email" id="email_email" required="" value="<?php echo $res['email_email']; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" style="text-transform:uppercase;">
                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña de Correo : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="password_email" id="password_email" required="" value="<?php echo $res['password_email']; ?>" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Puerto de Correo : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="number" class="form-control" name="puerto_email" id="puerto_email" required="" value="<?php echo $res['puerto_email']; ?>">
                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Color para Correos : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="color_correo" id="color_correo" required="" value="<?php echo $res['color_correo']; ?>">
                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Logo : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="file" class="form-control" name="logo" id="logo">
                            <br>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Favicon : </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="file" class="form-control" name="favicon" id="favicon">
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
        document.getElementById('pagina').disabled = true
        document.getElementById('sistema').disabled = true
        document.getElementById('titulo').disabled = true
        document.getElementById('pie_pagina').disabled = true
        document.getElementById('host_email').disabled = true
        document.getElementById('email_email').disabled = true
        document.getElementById('password_email').disabled = true
        document.getElementById('puerto_email').disabled = true
        document.getElementById('color_correo').disabled = true
        document.getElementById('logo').disabled = true
        document.getElementById('favicon').disabled = true
        document.getElementById('btn_cancelar').style.display = 'none'
        document.getElementById('btn_guardar').style.display = 'none'
        document.getElementById('btn_editar').style.display = ''
      };

      function activar_controles() {
        document.getElementById('pagina').disabled = false
        document.getElementById('sistema').disabled = false
        document.getElementById('titulo').disabled = false
        document.getElementById('pie_pagina').disabled = false
        document.getElementById('host_email').disabled = false
        document.getElementById('email_email').disabled = false
        document.getElementById('password_email').disabled = false
        document.getElementById('puerto_email').disabled = false
        document.getElementById('color_correo').disabled = false
        document.getElementById('logo').disabled = false
        document.getElementById('favicon').disabled = false
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
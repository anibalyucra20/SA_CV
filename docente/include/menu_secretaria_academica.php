<div class="navbar nav_title" style="border: 0;">
  <a href="index.html" class="site_title"><i class="fa fa-pencil"></i> <span>SIE</span></a>
</div>

<div class="clearfix"></div>
<!-- menu profile quick info -->
<div class="profile clearfix">
  <div class="profile_pic">
    <img src="img_docente/70198965.jpg" alt="..." class="img-circle profile_img">
  </div>
  <div class="profile_info">
    <span>Bienvenido,</span>
    <h2><?php echo $r_b_docente['apellidos_nombres']; ?></h2>
  </div>
</div>
<!-- /menu profile quick info -->

<br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
      <li><a href="index.php"><i class="fa fa-home"></i> Inicio </a>

      </li>
      <li><a><i class="fa fa-edit"></i> Planificación <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="periodo_academico.php">Periodo Académico</a></li>
          <li><a href="programacion_clases.php">Programación de Clases</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-desktop"></i> Matrícula <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="matriculas.php">Matrículas</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-table"></i> Docentes <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="docentes.php">Relación de Docentes</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-bar-chart-o"></i> Estudiantes <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="estudiantes.php">Relación de Estudiantes</a></li>
          <li><a href="apoderados.php">Relación de Apoderados</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-clone"></i>Evaluación <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="calificaciones_areas.php">Registro de Evaluación</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-clone"></i>Mantenimiento <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="datos_institucionales.php">Datos Institucionales</a></li>
          <li><a href="sedes.php">Sedes</a></li>
          <li><a href="periodo_lectivo.php">Periodo Léctivo</a></li>
          <li><a href="nivel.php">Niveles</a></li>
          <li><a href="ciclos.php">Ciclos</a></li>
          <li><a href="grados.php">Grados</a></li>
          <li><a href="turnos.php">Turnos</a></li>
          <li><a href="secciones.php">Secciones</a></li>
          <li><a href="cursos.php">Cursos</a></li>
          <li><a href="modalidad.php">Modalidades</a></li>
          <li><a href="datos_sistema.php">Datos de Sistema</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
<!-- /sidebar menu -->
</div>
</div>

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="img_docente/70198965.jpg" alt=""><?php echo $r_b_docente['apellidos_nombres']; ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="javascript:;"> Mi perfil</a></li>
            <li><a href="../include/cerrar_sesion.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión </a></li>
          </ul>
        </li>
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <?php
            $busc_sede_id = buscar_sedesPorId($conexion, $_SESSION['id_sede']);
            $res_busc_sede_id = mysqli_fetch_array($busc_sede_id);
            echo $res_busc_sede_id['nombre'];
            
            ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <?php
            $buscar_sedes = buscar_sedes($conexion);
            while ($res_buscar_sedes = mysqli_fetch_array($buscar_sedes)) {
            ?>
              <li><a href="operaciones/actualizar_sesion_sede.php?dato=<?php echo $res_buscar_sedes['id']; ?>"><?php if ($res_buscar_sedes['id'] == $_SESSION['id_sede']) {
                                                                                                                  echo "<b>";
                                                                                                                } ?><?php echo $res_buscar_sedes['nombre']; ?><?php if ($res_buscar_sedes['id'] == $_SESSION['id_sede']) {
                                                                                                                                                                    echo "</b>";
                                                                                                                                                                  } ?></a></li>
            <?php
            }
            ?>
          </ul>
        </li>
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <?php
            
            if ($_SESSION['anio_lectivo'] == '') {
              $b_ultimo_anio_acad = buscar_anio_academicoultimoporSede($conexion, $_SESSION['id_sede']);
              $rb_ultimo_sede = mysqli_fetch_array($b_ultimo_anio_acad);
              $_SESSION['anio_lectivo'] = $rb_ultimo_sede['id'];
            }
            $busc_anio_id = buscar_anio_academico_id($conexion, $_SESSION['anio_lectivo']);
            $res_busc_anio_id = mysqli_fetch_array($busc_anio_id);
            echo $res_busc_anio_id['nombre'];
            ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <?php
            $buscar_anios_Acad = buscar_anio_academicoInvertidoporSede($conexion, $_SESSION['id_sede']);
            while ($res_buscar_anios_Acad = mysqli_fetch_array($buscar_anios_Acad)) {
            ?>
              <li><a href="operaciones/actualizar_sesion_anio_acad.php?dato=<?php echo $res_buscar_anios_Acad['id']; ?>"><?php if ($res_buscar_anios_Acad['id'] == $_SESSION['anio_lectivo']) {
                                                                                                                            echo "<b>";
                                                                                                                          } ?><?php echo $res_buscar_anios_Acad['nombre']; ?><?php if ($res_buscar_anios_Acad['id'] == $_SESSION['anio_lectivo']) {
                                                                                                                                                                              echo "</b>";
                                                                                                                                                                            } ?></a></li>
            <?php
            }
            ?>
          </ul>
        </li>

      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->
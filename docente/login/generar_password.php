<?php

include('../../include/conexion.php');
include('../../include/busquedas.php');

$id_usuario = $_GET['id'];
$token = $_GET['token'];

$b_trabajador = buscar_docentePorId($conexion, $id_usuario);
$r_b_trabajador = mysqli_fetch_array($b_trabajador);

if ($r_b_trabajador['resset_password']==0 && !password_verify($r_b_trabajador['token_password'],$token)) {
        echo "<script>
                alert('Error, Este Link ya fue utilizado para el cambio de contraseña');
                window.location = '../login/';
            </script>";
}else{




?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-theme15.css">
</head>
<body>
    <div class="form-body">
        <div class="website-logo">
            <a href="index.html">
                <div class="logo">
                    <img class="logo-size" src="images/logo-light.svg" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>Get more things done with Loggin platform.</h3>
                    <p>Access to the most powerfull tool in the entire design and web industry.<br><br>
                        Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content form-sm">
                    <div class="form-items">
                        <h3 class="form-title">Recuperar Contraseña</h3>
                        <form action="registrar_nuevo_password.php" role="form" method="POST">
                            <input type="hidden" name="data" value="<?php echo $id_usuario; ?>">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="ingrese su nueva contraseña" required>
                                <input type="password" class="form-control" name="password_b" placeholder="repetir la contraseña" required>
                            </div>
                            <div class="form-button text-right">
                                    <button id="submit" type="submit" class="ibtn">Recuperar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>


<?php 
}
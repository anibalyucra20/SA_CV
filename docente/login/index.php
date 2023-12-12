<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iofrm</title>
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
                        <h3 class="form-title">Inicio de Sesión</h3>
                        <form action="iniciar_sesion.php" role="form" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
                                <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                            </div>
                            <div class="form-group">
                                <label>Olvidaste tu Contrasena?</label> <a href="recuperar_password.php">Recuperar Contraseña</a>
                            </div>
                            
                            <div class="form-button text-right">
                                    <button id="submit" type="submit" class="ibtn">Iniciar Sesión</button>
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
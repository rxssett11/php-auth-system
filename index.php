<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-10">
                <h3 class="text-center mb-4">LOGIN</h3>
                <p class="text-center ">Ingrese su usuario y contraseña</p>
                <br>
                <?php
                if (isset($_GET['error']) && $_GET['error'] == 1) {
                    echo "<p style='color:red'> Usuario y/o contraseña incorrectos...</p>";
                }
                ?>
                <form action="./includes/sesion/validarSesion.php" method="post">
                    <div class="form-group">
                        <label for="usuario" class="form-label fs-6">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required autocomplete="off">
                    </div>
                    <br>
                    <div class="form-group"">
                        <label for=" password" class="form-label fs-6">Contraseña:</label>
                        <input type="password" class="form-control" id="clave" name="clave" required autocomplete="off">
                    </div>
                    <br>
                    <center> <button type="submit" class="btn btn-primary ">Iniciar Sesión</button></center>
                </form>
                <br>
                <center>
                    <p>¿Aun no tienes cuenta?<a href="registro.php"> Registrar</a></p>
                </center>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
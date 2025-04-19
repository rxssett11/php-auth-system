<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-10">
                <h3 class="text-center mb-4">Registro De Usuario</h3>
                <p class="text-center ">Llena todos los campos completos</p>

                <?php
                if (isset($_GET['alert'])) {
                    if ($_GET['alert'] == 1) {
                        echo "<div class='alert alert-warning' role='alert'>
                    El usuario ingresado ya existe, inicie sesion o registre otro
                    </div>";
                    } elseif ($_GET['alert'] == 2) {
                        echo "<div class='alert alert-success' role='alert'>
                          Registro exitoso, puede iniciar sesión ahora
                          </div>";
                    } elseif ($_GET['alert'] == 3) {
                        echo "<div class='alert alert-danger' role='alert'>
                          Error al registrar, intente nuevamente
                          </div>";
                    } elseif ($_GET['alert'] == 4) {
                        echo "<div class='alert alert-info' role='alert'>
                         Las contraseñas ingresadas no coinciden
                          </div>";
                    }
                }
                ?>
                <form action="./includes/sesion/validarRegistro.php" method="post">
                    <div class="form-group">
                        <label for="usuario" class="form-label fs-6">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                    <br>
                    <div class="form-group"">
                        <label for=" password" class="form-label fs-6">Contraseña:</label>
                        <input type="password" class="form-control" id="clave" name="clave" required>
                    </div>
                    <br>
                    <div class="form-group"">
                        <label for=" password" class="form-label fs-6">Confirmar Contraseña:</label>
                        <input type="password" class="form-control" id="clave2" name="clave2" required>
                    </div>
                    <br>
                    <center> <button type="submit" class="btn btn-primary ">Crear Cuenta</button></center>
                </form>
                <br>
                <center>
                    <p>¿TIenes una cuenta?<a href="index.php"> Iniciar Sesion</a></p>
                </center>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
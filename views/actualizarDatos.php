<?php
include "../includes/configSession.php";
include "../includes/db.php";

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("ID no proporcionado.");
}

$id = $_GET['id'];

$query = "
    SELECT 
        dp.idDatosPersonales,
        dp.Nombre,
        dp.Edad,
        dp.RFC,
        dp.EstadoCivil,
        dp.CURP,
        d.pais,
        d.Ciudad,
        d.AlcaldiaMunicipio,
        d.Calle,
        d.NumeroExterior,
        d.NumeroInterior,
        c.Telefono,
        c.Email
    FROM DatosPersonales dp
    JOIN Direccion d ON dp.idDomicilio = d.idDireccion
    JOIN Contacto c ON dp.idContacto = c.idContacto
    WHERE dp.idDatosPersonales = ?
";

$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Registro no encontrado.");
}

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/formulario.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card p-4">
            <h1 class="text-center mb-4">Editar Datos Personales</h1>
            <!--- ELIMINAR CON POST--->
            <form action="../includes/controllers/eliminar.php" method="post"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.');" class="mt-2 text-end">
                <input type="hidden" name="id" value="<?= $row['idDatosPersonales'] ?>">
                <input type="submit" class="btn btn-danger" value="Eliminar Registro">
            </form>

            <form action="../includes/controllers/actualizar.php" method="post">
                <input type="hidden" name="id" value="<?= $row['idDatosPersonales'] ?>">

                <!-- DATOS PERSONALES -->
                <div class="form-section">
                    <h2>Datos Personales</h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= htmlspecialchars($row['Nombre']) ?>" required autocomplete="off">
                        </div>

                        <div class="col-md-6">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" id="edad" name="edad" class="form-control" value="<?= $row['Edad'] ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" id="rfc" name="rfc" class="form-control" value="<?= $row['RFC'] ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="estadoCivil" class="form-label">Estado Civil</label>
                            <input type="text" id="estadoCivil" name="estadoCivil" class="form-control" value="<?= $row['EstadoCivil'] ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="curp" class="form-label">CURP</label>
                            <input type="text" id="curp" name="curp" class="form-control" value="<?= $row['CURP'] ?>" required>
                        </div>
                    </div>
                </div>

                <!-- DIRECCIÓN -->
                <div class="form-section mt-4">
                    <h2>Dirección</h2>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="pais" class="form-label">País</label>
                            <input type="text" id="pais" name="pais" class="form-control" value="<?= $row['pais'] ?>" required>
                        </div>

                        <div class="col-md-4">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" id="ciudad" name="ciudad" class="form-control" value="<?= $row['Ciudad'] ?>" required>
                        </div>

                        <div class="col-md-4">
                            <label for="alcaldia" class="form-label">Alcaldía/Municipio</label>
                            <input type="text" id="alcaldia" name="alcaldia" class="form-control" value="<?= $row['AlcaldiaMunicipio'] ?>" required>
                        </div>

                        <div class="col-md-4">
                            <label for="calle" class="form-label">Calle</label>
                            <input type="text" id="calle" name="calle" class="form-control" value="<?= $row['Calle'] ?>" required>
                        </div>

                        <div class="col-md-4">
                            <label for="numeroExterior" class="form-label">Número Exterior</label>
                            <input type="text" id="numeroExterior" name="numeroExterior" class="form-control" value="<?= $row['NumeroExterior'] ?>" required>
                        </div>

                        <div class="col-md-4">
                            <label for="numeroInterior" class="form-label">Número Interior</label>
                            <input type="text" id="numeroInterior" name="numeroInterior" class="form-control" value="<?= $row['NumeroInterior'] ?>">
                        </div>
                    </div>
                </div>

                <!-- CONTACTO -->
                <div class="form-section mt-4">
                    <h2>Contacto</h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" class="form-control" value="<?= $row['Telefono'] ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= $row['Email'] ?>" required>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="../includes/controllers/actualizar.php" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" class="btn btn-primary" value="Actualizar Datos">
                </div>
            </form>

        </div>
        </form>
    </div>
    </div>
</body>

</html>
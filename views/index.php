<?php
include "../includes/configSession.php";
include "../includes/db.php";

session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: ../index.php");
    exit();
}

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
";

$result = $conexion->query($query);

if (!$result) {
    die("Error en la consulta: " . $conexion->error);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Datos Personales</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/table.css">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Datos Registrados</h1>
            <a href="registroFormulario.php" class="btn btn-success">Agregar nuevo registro</a>
            <a href="../includes/sesion/cerrarSesion.php" class="btn btn-outline-danger">Cerrar sesión</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>RFC</th>
                        <th>Edo. Civil</th>
                        <th>CURP</th>
                        <th>País</th>
                        <th>Ciudad</th>
                        <th>Alcaldía</th>
                        <th>Calle</th>
                        <th>Núm.Ext.</th>
                        <th>Núm.Int.</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['Nombre']) ?></td>
                            <td><?= htmlspecialchars($row['Edad']) ?></td>
                            <td><?= htmlspecialchars($row['RFC']) ?></td>
                            <td><?= htmlspecialchars($row['EstadoCivil']) ?></td>
                            <td><?= htmlspecialchars($row['CURP']) ?></td>
                            <td><?= htmlspecialchars($row['pais']) ?></td>
                            <td><?= htmlspecialchars($row['Ciudad']) ?></td>
                            <td><?= htmlspecialchars($row['AlcaldiaMunicipio']) ?></td>
                            <td><?= htmlspecialchars($row['Calle']) ?></td>
                            <td><?= htmlspecialchars($row['NumeroExterior']) ?></td>
                            <td><?= htmlspecialchars($row['NumeroInterior']) ?></td>
                            <td><?= htmlspecialchars($row['Telefono']) ?></td>
                            <td><?= htmlspecialchars($row['Email']) ?></td>
                            <td> <a href="actualizarDatos.php?id=<?= $row['idDatosPersonales'] ?>" class="btn btn-warning">Actualizar</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
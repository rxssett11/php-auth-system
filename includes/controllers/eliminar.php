<?php
include "../configSession.php";
include "../db.php";

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $query = "DELETE dp, d, c
              FROM DatosPersonales dp
              JOIN Direccion d ON dp.idDomicilio = d.idDireccion
              JOIN Contacto c ON dp.idContacto = c.idContacto
              WHERE dp.idDatosPersonales = ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../../views/index.php?msg=Registro eliminado");
    } else {
        echo "Error al eliminar el registro.";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Solicitud no válida.";
}

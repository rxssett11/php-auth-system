<?php
include "../configSession.php";
include "../db.php";

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

if (
    !isset(
        $_POST['id'],
        $_POST['nombre'],
        $_POST['edad'],
        $_POST['rfc'],
        $_POST['estadoCivil'],
        $_POST['curp'],
        $_POST['pais'],
        $_POST['ciudad'],
        $_POST['alcaldia'],
        $_POST['calle'],
        $_POST['numeroExterior'],
        $_POST['telefono'],
        $_POST['email']
    )
) {
    die("Faltan datos para actualizar.");
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$rfc = $_POST['rfc'];
$estadoCivil = $_POST['estadoCivil'];
$curp = $_POST['curp'];

$pais = $_POST['pais'];
$ciudad = $_POST['ciudad'];
$alcaldia = $_POST['alcaldia'];
$calle = $_POST['calle'];
$numeroExterior = $_POST['numeroExterior'];
$numeroInterior = $_POST['numeroInterior'] ?? '';

$telefono = $_POST['telefono'];
$email = $_POST['email'];

// Obtener IDs relacionados
$query = "SELECT idDomicilio, idContacto FROM DatosPersonales WHERE idDatosPersonales = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Registro no encontrado.");
}

$data = $result->fetch_assoc();
$idDomicilio = $data['idDomicilio'];
$idContacto = $data['idContacto'];

// Actualizar DatosPersonales
$stmt = $conexion->prepare("
    UPDATE DatosPersonales 
    SET Nombre = ?, Edad = ?, RFC = ?, EstadoCivil = ?, CURP = ?
    WHERE idDatosPersonales = ?
");
$stmt->bind_param("sisssi", $nombre, $edad, $rfc, $estadoCivil, $curp, $id);
$stmt->execute();

// Actualizar Direccion
$stmt = $conexion->prepare("
    UPDATE Direccion 
    SET pais = ?, Ciudad = ?, AlcaldiaMunicipio = ?, Calle = ?, NumeroExterior = ?, NumeroInterior = ?
    WHERE idDireccion = ?
");
$stmt->bind_param("ssssssi", $pais, $ciudad, $alcaldia, $calle, $numeroExterior, $numeroInterior, $idDomicilio);
$stmt->execute();

// Actualizar Contacto
$stmt = $conexion->prepare("
    UPDATE Contacto 
    SET Telefono = ?, Email = ?
    WHERE idContacto = ?
");
$stmt->bind_param("ssi", $telefono, $email, $idContacto);
$stmt->execute();

// Redirigir de nuevo al listado
header("Location: index.php");
exit();

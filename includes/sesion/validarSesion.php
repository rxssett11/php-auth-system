<?php
session_start();
include "../db.php";

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$stmt = $conexion->prepare("SELECT usuario, clave FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hash_clave = $row['clave'];


    if (password_verify($clave, $hash_clave)) {

        echo $clave, $hash_clave;

        $_SESSION['usuario'] = $usuario;
        //$_SESSION['id_rol'] = $row['id_rol'];

        header("Location: ../../views/index.php");
        exit();
    } else {

        header("Location: ../../index.php?error=1");
        exit();
    }
} else {

    header("Location: ../../index.php?error=1");
    exit();
}

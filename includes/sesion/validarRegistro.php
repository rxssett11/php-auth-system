<?php
session_start();
include "../db.php";

extract($_POST);

$clave = mysqli_real_escape_string($conexion, trim($_POST['clave']));
$clave2 = mysqli_real_escape_string($conexion, trim($_POST['clave2']));
$id_rol = "2";

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$validuser = mysqli_query($conexion, $sql);
$rows = mysqli_num_rows($validuser);
if ($rows >= 1) {
    header("Location: ../../registro.php?alert=1");
    exit();
}
if (strcmp($clave, $clave2) !== 0) {
    header("Location: ../../registro.php?alert=4");
    exit();
} else {
    $clave = password_hash($clave, PASSWORD_DEFAULT);

    $consulta = "INSERT INTO usuarios (usuario, clave, id_rol)
VALUES ('$usuario',  '$clave', '$id_rol')";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        header("Location: ../../registro.php?alert=2");
    } else {
        header("Location: ../../registro.php?alert=3");
        exit();
    }
}

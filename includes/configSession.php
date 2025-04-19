<?php
error_reporting(0);
session_start();
$usuario  = $_SESSION['usuario'];
if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Primero debes iniciar sesión y Validar tus credenciales..');</script>";
    echo "<script>location.assign('../index.php');</script>";
    exit();
}
    
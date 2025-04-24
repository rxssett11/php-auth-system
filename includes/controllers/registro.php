<?php
include '../db.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $rfc = $_POST['rfc'];
    $estadoCivil = $_POST['estadoCivil'];
    $curp = $_POST['curp'];

    $cp = $_POST['cp'];
    $colonia = $_POST['colonia'];
    $alcaldia = $_POST['alcaldia'];
    $estado = $_POST['estado'];
    $calle = $_POST['calle'];
    $numeroExterior = $_POST['numeroExterior'];
    $numeroInterior = $_POST['numeroInterior'];

    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sqlDireccion = "INSERT INTO Direccion (pais, Ciudad, AlcaldiaMunicipio, Calle, NumeroExterior, NumeroInterior)
                     VALUES ('$estado', '$colonia', '$alcaldia', '$calle', '$numeroExterior', '$numeroInterior')";

    if ($conexion->query($sqlDireccion) === TRUE) {
        $idDomicilio = $conexion->insert_id;
    } else {
        die("Error al insertar en Direccion: " . $conexion->error);
    }

    $sqlContacto = "INSERT INTO Contacto (Telefono, Email)
                    VALUES ('$telefono', '$email')";

    if ($conexion->query($sqlContacto) === TRUE) {
        $idContacto = $conexion->insert_id;
    } else {
        die("Error al insertar en Contacto: " . $conexion->error);
    }

    $sqlDatosPersonales = "INSERT INTO DatosPersonales (Nombre, Edad, RFC, idDomicilio, EstadoCivil, CURP, idContacto)
                           VALUES ('$nombre', $edad, '$rfc', $idDomicilio, '$estadoCivil', '$curp', $idContacto)";

    if ($conexion->query($sqlDatosPersonales) === TRUE) {
        echo "<div style='text-align:center; margin-top:20px;'>✅ Datos guardados correctamente. Redirigiendo...</div>";
        echo "<script>
            setTimeout(() => {
                window.location.href = '../../views/index.php';
            }, 2000);
          </script>";
    } else {
        echo "❌ Error al insertar en DatosPersonales: " . $conexion->error;
    }
}

$conexion->close();

<?php
include "../includes/configSession.php";
include "../includes/db.php";

session_start();

if(!isset($_SESSION['usuario'])) {
    header("location ../index.php");
    exit();
}

$query = "SELECT usuario, clave FROM usuarios";
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
    <title>Formulario de Datos Personales</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/principal.css">
    <link rel="stylesheet" href="../css/formulario.css">
</head>

<body>
    <div class="container my-5">
        <div class="card p-4">
            <h1 class="text-center mb-4">Formulario de Datos Personales</h1>
            <form action="../includes/controllers/registro.php" method="post">
                
                <!-- DATOS PERSONALES -->
                <div class="form-section">
                    <h2>Datos Personales</h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required autocomplete="off">
                        </div>

                        <div class="col-md-6">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" id="edad" name="edad" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" id="rfc" name="rfc" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="estadoCivil" class="form-label">Estado Civil</label>
                            <input type="text" id="estadoCivil" name="estadoCivil" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="curp" class="form-label">CURP</label>
                            <input type="text" id="curp" name="curp" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- DIRECCIÓN -->
                <div class="form-section">
                    <h2>Dirección</h2>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="cp" class="form-label">Código Postal</label>
                            <input type="number" id="cp" name="cp" class="form-control" required oninput="autocompletarDireccion()">
                        </div>

                        <div class="col-md-4">
                            <label for="colonia" class="form-label">Colonia</label>
                            <select id="colonia" name="colonia" class="form-select" required></select>
                        </div>

                        <div class="col-md-4">
                            <label for="alcaldia" class="form-label">Alcaldía/Municipio</label>
                            <input type="text" id="alcaldia" name="alcaldia" class="form-control" readonly required>
                        </div>

                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <input type="text" id="estado" name="estado" class="form-control" readonly required>
                        </div>

                        <div class="col-md-4">
                            <label for="calle" class="form-label">Calle</label>
                            <input type="text" id="calle" name="calle" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label for="numeroExterior" class="form-label">Número Exterior</label>
                            <input type="text" id="numeroExterior" name="numeroExterior" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label for="numeroInterior" class="form-label">Número Interior</label>
                            <input type="text" id="numeroInterior" name="numeroInterior" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- CONTACTO -->
                <div class="form-section">
                    <h2>Contacto</h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- BOTÓN -->
                <div class="mt-4">
                    <input type="submit" class="btn btn-success btn-guardar" value="Guardar Datos">
                </div>
            </form>
        </div>
    </div>

    <script type="module">
        import {
            colonias,
            buscarPorCP
        } from "../js/colonias.js";

        window.autocompletarDireccion = () => {
            const cp = parseInt(document.getElementById("cp").value);
            const resultados = buscarPorCP(cp);

            const coloniaSelect = document.getElementById("colonia");
            const alcaldia = document.getElementById("alcaldia");
            const estado = document.getElementById("estado");

            coloniaSelect.innerHTML = "";

            if (resultados.length > 0) {
                resultados.forEach(r => {
                    const option = document.createElement("option");
                    option.value = r.colonia;
                    option.textContent = r.colonia;
                    coloniaSelect.appendChild(option);
                });

                alcaldia.value = resultados[0].alcaldia;
                estado.value = resultados[0].estado;
            } else {
                coloniaSelect.innerHTML = "<option>Sin resultados</option>";
                alcaldia.value = "";
                estado.value = "";
            }
        };
    </script>
</body>

</html>

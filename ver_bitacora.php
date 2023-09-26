<?php
// ver_bitacora.php

include("verificar_bitacora.php");
include("conexion.php");

// Obtener el ID de la bitácora desde la URL
if (isset($_GET['bitacora_id'])) {
    $bitacora_id = $_GET['bitacora_id'];
} else {
    // Redirige a la página de bitácora si no se proporciona un ID válido
    header('Location: bitacora.php');
    exit;
}

// Realizar una consulta SQL para obtener los detalles de la bitácora específica
$consulta_bitacora = "SELECT * FROM bitacoras WHERE bitacora_id = $bitacora_id";
$resultado_bitacora = mysqli_query($conexion, $consulta_bitacora);

// Verificar si se encontró la bitácora
if (!$resultado_bitacora || mysqli_num_rows($resultado_bitacora) == 0) {
    // Redirige a la página de bitácora si no se encuentra la bitácora
    header('Location: bitacora.php');
    exit;
}

$bitacora = mysqli_fetch_assoc($resultado_bitacora);

// Realizar una consulta SQL para obtener los registros asociados a la bitácora específica
$consulta_registros = "SELECT * FROM registros WHERE bitacora_id = $bitacora_id";
$resultado_registros = mysqli_query($conexion, $consulta_registros);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./bitacora.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
    <title>Bitácora</title>
</head>
<body style="background-color: #002069">
<a href="historial.php" class="button">Regresar</a>
<header>
    <img class="header-image" alt="" src="./public/frame1.png" />
</header>
<div class="bitacora">
    <h2>Detalles de la bitácora</h2>
    <p>Bitácora ID: <?php echo $bitacora['bitacora_id']; ?></p>
    <p>Nombre de la bitácora: <?php echo $bitacora['nombre_bitacora']; ?></p>
    <p>Fecha de creación: <?php echo $bitacora['fecha_creacion_bitacora']; ?></p>
    <!-- Agrega más detalles de la bitácora según tus necesidades -->
    <div class="scrollable-table-container">
        <table id="bitacoraTable">
            <thead>
            <tr>
                <th>Registro ID</th>
                <th>Número de sala</th>
                <th>Hora de la función</th>
                <th>Número de clientes en sala</th>
                <th>Boletos vendidos en sistema</th>
                <th>Cortesías generadas en sistema</th>
                <th>Responsable de conteo</th>
                <th>Responsable de sala</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($resultado_registros)) {
                ?>
                <tr>
                    <td><?php echo $row['registro_id']; ?></td>
                    <td><?php echo $row['numero_sala']; ?></td>
                    <td><?php echo $row['hora_funcion']; ?></td>
                    <td><?php echo $row['clientes_sala']; ?></td>
                    <td><?php echo $row['boletos_vendidos']; ?></td>
                    <td><?php echo $row['cortesias_generadas']; ?></td>
                    <td><?php echo $row['responsable_conteo']; ?></td>
                    <td><?php echo $row['responsable_sala']; ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<footer>
    <p>
        Contenido del sitio 2023© Derechos reservados Exhibidora Mexicana Cinépolis®, S.A. de C.V.
    </p>
</footer>
</body>
</html>

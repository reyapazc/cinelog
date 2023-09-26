<?php
// historial.php
include("conexion.php");

$consulta = "SELECT * FROM bitacoras";
$resultado = mysqli_query($conexion, $consulta);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <title>CineLog</title>

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./historial.css" />
    <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap"
    />
</head>
<body style="background-color: #002069">
<a href="menu.php" class="button">Regresar</a>
<header>
    <img class="header-image" alt="" src="./public/frame1.png" />
</header>
<div class="bitacora">
    <div class="scrollable-table-container">
        <table id="bitacoraTable">
            <thead>
            <tr>
                <th>Bitácora ID</th>
                <th>Nombre de la Bitácora</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($fila = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
                    <td><?php echo $fila['bitacora_id']; ?></td>
                    <td><?php echo $fila['nombre_bitacora']; ?></td>
                    <td><?php echo $fila['fecha_creacion_bitacora']; ?></td>
                    <td>
                        <a class="button-editar" href="ver_bitacora.php?bitacora_id=<?php echo $fila['bitacora_id']; ?>">Ver</a>
                    </td>
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

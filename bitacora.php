<?php
include("verificar_bitacora.php"); // Incluye el archivo de verificación.
include("conexion.php");
$registros = "SELECT * FROM registros";
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
<a href="menu.php" class="button">Regresar</a>
<header>
    <img class="header-image" alt="" src="./public/frame1.png" />
</header>
<div class="bitacora">
    <!-- Parte de arriba con 7 textos, 7 inputs y un botón -->
    <form id="bitacoraForm" method="post" action="guardar_datos.php">
        <div class="form-row-container">
            <div class="form-row">
                <label>Número de sala:</label>
                <input type="text" name="numero_sala">
            </div>
            <div class="form-row">
                <label>Hora de la función:</label>
                <input type="text" name="hora_funcion">
            </div>
        </div>

        <div class="form-row-container">
            <div class="form-row">
                <label>Número de clientes en sala:</label>
                <input type="text" name="clientes_sala">
            </div>
            <div class="form-row">
                <label>Boletos vendidos en sistema:</label>
                <input type="text" name="boletos_vendidos">
            </div>
        </div>

        <div class="form-row-container">
            <div class="form-row">
                <label>Cortesías generadas en sistema:</label>
                <input type="text" name="cortesias_generadas">
            </div>
            <div class="form-row">
                <label>Responsable de conteo:</label>
                <input type="text" name="responsable_conteo">
            </div>
        </div>

        <div class="form-row-container">
            <div class="form-row">
                <label>Responsable de sala:</label>
                <input type="text" name="responsable_sala">
            </div>
            <div class="button-container">
                <button type="submit"">Guardar</button>
            </div>
        </div>
    </form>
    <div class="scrollable-table-container">
    <table id="bitacoraTable">
        <thead>
        <tr>
            <th>Registro ID:</th>
            <th>Número de sala:</th>
            <th>Hora de la función:</th>
            <th>Número de clientes en sala:</th>
            <th>Boletos vendidos en sistema:</th>
            <th>Cortesías generadas en sistema:</th>
            <th>Responsable de conteo:</th>
            <th>Responsable de sala:</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $resultado = mysqli_query($conexion, $registros);
        while ($row = mysqli_fetch_assoc($resultado)) {
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
                <td>
                    <a class="button-editar" href="editar.php?registro_id=<?php echo $row['registro_id']; ?>">Editar</a>
                    <a class="button-eliminar" href="eliminar.php?registro_id=<?php echo $row['registro_id']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<footer>
    <p>
        Contenido del sitio 2023© Derechos reservados Exhibidora Mexicana Cinépolis®, S.A. de C.V.
    </p>
</footer>
</body>
</html>

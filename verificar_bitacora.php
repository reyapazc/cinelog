<?php
include("conexion.php"); // Asegúrate de incluir tu archivo de conexión a la base de datos aquí.

// Función para verificar si existe una bitácora para el día de hoy
function verificarBitacoraHoy($conexion) {
    $fechaHoy = date("Y-m-d");
    $query = "SELECT * FROM bitacoras WHERE fecha_creacion_bitacora = '$fechaHoy'";
    $result = mysqli_query($conexion, $query);

    return mysqli_num_rows($result) > 0;
}

if (!verificarBitacoraHoy($conexion)) {
    // No se ha creado una bitácora para hoy, redirige a otra página o muestra un mensaje de error.
    header("Location: menu.php?mensaje=No se ha creado una bitácora para hoy.");
    exit;
}

?>

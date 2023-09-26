<?php
function obtenerBitacoraId($conexion) {
    $fecha_actual = date('Y-m-d');
    $query = "SELECT bitacora_id FROM bitacoras WHERE fecha_creacion_bitacora = '$fecha_actual'";
    $resultado = $conexion->query($query);
    if ($resultado && $resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        return $row['bitacora_id'];
    } else {
        // Si no se encuentra una bitácora para el día de hoy, puedes manejarlo según tus necesidades.
        // Por ejemplo, puedes crear una nueva bitácora para el día de hoy aquí y devolver su ID.
        // Asegúrate de adaptar esta lógica a tu estructura de base de datos.
        return 0; // Por ejemplo, puedes devolver 0 si no hay una bitácora existente.
    }
}
?>

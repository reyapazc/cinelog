<?php
include("conexion.php"); // Incluye el archivo de conexión a la base de datos

// Verifica si se ha proporcionado un registro_id válido
if (isset($_GET['registro_id'])) {
    $registro_id = $_GET['registro_id'];

    // Elimina el registro de la base de datos
    $sql = "DELETE FROM registros WHERE registro_id = $registro_id";

    if ($conexion->query($sql) === TRUE) {
        echo "El registro se eliminó correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
} else {
    // Si no se proporciona un registro_id válido, puedes mostrar un mensaje de error o redirigir a otra página.
    echo "Error: No se proporcionó un registro para eliminar.";
    exit; // Terminar el script
}

// Redirige de vuelta a la página principal o a donde desees después de eliminar el registro
header("Location: bitacora.php");
exit; // Terminar el script
?>

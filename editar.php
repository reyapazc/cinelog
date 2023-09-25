<?php
include("conexion.php"); // Incluye el archivo de conexión a la base de datos

// Verifica si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $registro_id = $_POST['registro_id'];
    $numero_sala = $_POST['numero_sala'];
    $hora_funcion = $_POST['hora_funcion'];
    $clientes_sala = $_POST['clientes_sala'];
    $boletos_vendidos = $_POST['boletos_vendidos'];
    $cortesias_generadas = $_POST['cortesias_generadas'];
    $responsable_conteo = $_POST['responsable_conteo'];
    $responsable_sala = $_POST['responsable_sala'];

    // Actualiza los valores en la base de datos
    $sql = "UPDATE registros SET
            numero_sala = '$numero_sala',
            hora_funcion = '$hora_funcion',
            clientes_sala = '$clientes_sala',
            boletos_vendidos = '$boletos_vendidos',
            cortesias_generadas = '$cortesias_generadas',
            responsable_conteo = '$responsable_conteo',
            responsable_sala = '$responsable_sala'
            WHERE registro_id = $registro_id";

    if ($conexion->query($sql) === TRUE) {
        header ("Location: bitacora.php");
        echo "Los datos se actualizaron correctamente.";
    } else {
        echo "Error al actualizar los datos: " . $conexion->error;
    }
}

// Obtener el registro a editar
if (isset($_GET['registro_id'])) {
    $registro_id = $_GET['registro_id'];
    $consulta = "SELECT * FROM registros WHERE registro_id = $registro_id";
    $resultado = mysqli_query($conexion, $consulta);
    $row = mysqli_fetch_assoc($resultado);
} else {
    // Si no se proporciona un registro_id válido, puedes mostrar un mensaje de error o redirigir a otra página.
    header ("Location: bitacora.php");
    echo "Error: No se proporcionó un registro para editar.";
    exit; // Terminar el script
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./bitacora.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
    <title>Editar Registro</title>
</head>
<body style="background-color: #002069">
<a href="bitacora.php" class="button">Regresar</a>
<header>
    <img class="header-image" alt="" src="./public/frame1.png" />
</header>
<div class="editar-registro">
    <form id="bitacoraForm" method="post" action="editar.php">
        <div class="form-row-container">
            <div class="form-row">
                <label>Número de sala:</label>
                <input type="text" name="numero_sala" value="<?php echo $row['numero_sala']; ?>">
            </div>
            <div class="form-row">
                <label>Hora de la función:</label>
                <input type="text" name="hora_funcion" value="<?php echo $row['hora_funcion']; ?>">
            </div>
        </div>

        <div class="form-row-container">
            <div class="form-row">
                <label>Número de clientes en sala:</label>
                <input type="text" name="clientes_sala" value="<?php echo $row['clientes_sala']; ?>">
            </div>
            <div class="form-row">
                <label>Boletos vendidos en sistema:</label>
                <input type="text" name="boletos_vendidos" value="<?php echo $row['boletos_vendidos']; ?>">
            </div>
        </div>

        <div class="form-row-container">
            <div class="form-row">
                <label>Cortesías generadas en sistema:</label>
                <input type="text" name="cortesias_generadas" value="<?php echo $row['cortesias_generadas']; ?>">
            </div>
            <div class="form-row">
                <label>Responsable de conteo:</label>
                <input type="text" name="responsable_conteo" value="<?php echo $row['responsable_conteo']; ?>">
            </div>
        </div>

        <div class="form-row-container">
            <div class="form-row">
                <label>Responsable de sala:</label>
                <input type="text" name="responsable_sala" value="<?php echo $row['responsable_sala']; ?>">
            </div>
            <div class="button-container">
                <button type="submit"">Guardar</button>
                <input type="hidden" name="registro_id" value="<?php echo $row['registro_id']; ?>"
            </div>
        </div>
    </form>
</div>
<footer>
    <p>
        Contenido del sitio 2023© Derechos reservados Exhibidora Mexicana Cinépolis®, S.A. de C.V.
    </p>
</footer>
</body>
</html>

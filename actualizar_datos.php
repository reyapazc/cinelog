<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cinelog";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }

    $registro_id = $_POST['registro_id'];
    $numero_sala = $_POST['numero_sala'];
    $hora_funcion = $_POST['hora_funcion'];
    $clientes_sala = $_POST['clientes_sala'];
    $boletos_vendidos = $_POST['boletos_vendidos'];
    $cortesias_generadas = $_POST['cortesias_generadas'];
    $responsable_conteo = $_POST['responsable_conteo'];
    $responsable_sala = $_POST['responsable_sala'];

    $sql = "UPDATE registros SET numero_sala='$numero_sala', hora_funcion='$hora_funcion', clientes_sala='$clientes_sala', boletos_vendidos='$boletos_vendidos', cortesias_generadas='$cortesias_generadas', responsable_conteo='$responsable_conteo', responsable_sala='$responsable_sala' WHERE registro_id=$registro_id";

    if ($conn->query($sql) === TRUE) {
        echo "Los datos se actualizaron correctamente.";
    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Error: No se recibieron datos del formulario.";
}
?>

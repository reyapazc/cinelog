<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configura los datos de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cinelog";

    // Crea una conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }

    // Obtén la fecha actual (puedes personalizar el formato según tu base de datos)
    $fecha_actual = date("Y-m-d");

    // Consulta la tabla 'bitacoras' para obtener el bitacora_id correspondiente a la fecha actual
    $sql_bitacora = "SELECT bitacora_id FROM bitacoras WHERE fecha_creacion_bitacora = '$fecha_actual'";
    $result_bitacora = $conn->query($sql_bitacora);

    if ($result_bitacora->num_rows > 0) {
        // Si se encuentra una bitácora existente para la fecha actual, obtén su bitacora_id
        $row_bitacora = $result_bitacora->fetch_assoc();
        $bitacora_id = $row_bitacora['bitacora_id'];

        // Obtén los valores del formulario
        $numero_sala = $_POST['numero_sala'];
        $hora_funcion = $_POST['hora_funcion'];
        $clientes_sala = $_POST['clientes_sala'];
        $boletos_vendidos = $_POST['boletos_vendidos'];
        $cortesias_generadas = $_POST['cortesias_generadas'];
        $responsable_conteo = $_POST['responsable_conteo'];
        $responsable_sala = $_POST['responsable_sala'];

        // Inserta los valores en la tabla 'registros' junto con el bitacora_id
        $sql = "INSERT INTO registros (bitacora_id, numero_sala, hora_funcion, clientes_sala, boletos_vendidos, cortesias_generadas, responsable_conteo, responsable_sala)
                VALUES ('$bitacora_id', '$numero_sala', '$hora_funcion', '$clientes_sala', '$boletos_vendidos', '$cortesias_generadas', '$responsable_conteo', '$responsable_sala')";

        if ($conn->query($sql) === TRUE) {
            header ("Location: bitacora.php?mensaje=Los datos se guardaron correctamente.");
            echo "Los datos se guardaron correctamente.";
        } else {
            header ("Location: bitacora.php?mensaje=Error al guardar los datos: " . $conn->error);
            echo "Error al guardar los datos: " . $conn->error;
        }
    } else {
        // Si no se encuentra una bitácora existente, no hace nada
        header ("Location: bitacora.php?mensaje=No se encontró una bitácora existente para la fecha actual. No se han guardado los datos.");
        echo "No se encontró una bitácora existente para la fecha actual. No se han guardado los datos.";
    }

    // Cierra la conexión
    $conn->close();
} else {
    // Si no se envió el formulario, muestra un mensaje de error o redirige a la página del formulario
    header ("Location: bitacora.php?mensaje=Error: No se recibieron datos del formulario.");
    echo "Error: No se recibieron datos del formulario.";
}
?>

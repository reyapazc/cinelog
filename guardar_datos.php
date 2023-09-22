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

    // Obtiene los valores del formulario
    $registro_id = $_POST['registro_id'];
    $numero_sala = $_POST['numero_sala'];
    $hora_funcion = $_POST['hora_funcion'];
    $clientes_sala = $_POST['clientes_sala'];
    $boletos_vendidos = $_POST['boletos_vendidos'];
    $cortesias_generadas = $_POST['cortesias_generadas'];
    $responsable_conteo = $_POST['responsable_conteo'];
    $responsable_sala = $_POST['responsable_sala'];

    // Inserta los valores en la base de datos
    $sql = "INSERT INTO registros (numero_sala, hora_funcion, clientes_sala, boletos_vendidos, cortesias_generadas, responsable_conteo, responsable_sala)
            VALUES ('$numero_sala', '$hora_funcion', '$clientes_sala', '$boletos_vendidos', '$cortesias_generadas', '$responsable_conteo', '$responsable_sala')";

    if ($conn->query($sql) === TRUE) {
        echo "Los datos se guardaron correctamente.";
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }

    // Cierra la conexión
    $conn->close();
} else {
    // Si no se envió el formulario, muestra un mensaje de error o redirige a la página del formulario
    echo "Error: No se recibieron datos del formulario.";
}
?>

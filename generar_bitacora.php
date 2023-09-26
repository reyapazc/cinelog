<?php
// Archivo: generar_bitacora.php

// Configura los datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "cinelog";

// Crea una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtén la fecha actual en el formato YYYY-MM-DD
$fechaHoy = date("Y-m-d");

// Verifica si ya existe una bitácora para la fecha de hoy
$query = "SELECT * FROM bitacoras WHERE fecha_creacion_bitacora = '$fechaHoy'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Ya se ha creado una bitácora hoy, redirigimos de nuevo a menu.php con un mensaje de error
    header("Location: menu.php?mensaje=Ya fue creada la bitácora");
    exit;
}

// Genera el nombre de la nueva bitácora
$nombreBitacora = "Bitacora_" . date("Ymd");

// Inserta una nueva entrada en la tabla Bitacoras
$query = "INSERT INTO bitacoras (nombre_bitacora, fecha_creacion_bitacora) VALUES ('$nombreBitacora', '$fechaHoy')";

if ($conn->query($query) === TRUE) {
    // Redirige a menu.php con un mensaje de éxito como parámetro GET
    header("Location: menu.php?mensaje=Bitácora generada con éxito.");
} else {
    // Redirige a menu.php con un mensaje de error como parámetro GET
    header("Location: menu.php?mensaje=Error al generar la bitácora: " . $conn->error);
}

// Cierra la conexión cuando hayas terminado
$conn->close();
?>

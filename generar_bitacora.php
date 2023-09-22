<?php
// Archivo: generar_bitacora.php

// Inicia o reanuda la sesión
session_start();

// Verifica si ya se ha creado una bitácora hoy
if (isset($_SESSION['bitacoraGenerada'])) {
    header("Location: menu.php?mensaje=Ya fue creada la bitácora");
    exit;
}

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

// Genera el nombre de la nueva bitácora
$nombreBitacora = "Bitacora_" . date("Ymd");

// Inserta una nueva entrada en la tabla Bitacoras
$query = "INSERT INTO Bitacoras (nombre_bitacora) VALUES ('$nombreBitacora')";
    
if ($conn->query($query) === TRUE) {
    // Establece una variable de sesión para evitar que se genere otra bitácora hoy
    $_SESSION['bitacoraGenerada'] = true;

    // Redirige a menu.php con un mensaje de éxito como parámetro GET
    header("Location: menu.php?mensaje=Bitácora generada con éxito.");
} else {
    // Redirige a menu.php con un mensaje de error como parámetro GET
    header("Location: menu.php?mensaje=Error al generar la bitácora: " . $conn->error);
}

// Cierra la conexión cuando hayas terminado
$conn->close();
?>

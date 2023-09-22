<?php
// Archivo: procesar_login.php

// Configura los datos de conexión a la base de datos
$servername = "localhost";  // Cambia esto por la dirección de tu servidor MySQL
$username = "root";
$password = "";
$database = "cinelog";

// Crea una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibe los datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

// Realiza operaciones en la base de datos, como verificar el usuario y contraseña
// Ejemplo de consulta para verificar el usuario y contraseña (debes personalizarla):
$query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
$result = $conn->query($query);

// Verifica si se encontró un registro que coincide con las credenciales
if ($result->num_rows > 0) {
    // Comprueba si el usuario es "cinepolito"
    if ($usuario == "cinepolito") {
        // Si es "cinepolito", redirige a "bitacora.html"
        header("Location: bitacora.php");
    } elseif ($usuario == "admin") {
        // Comprueba si el usuario es "admin"
        // Si es "admin", redirige a "menu.html"
        header("Location: menu.php");
    } else {
        // En caso contrario, redirige a "otra_pagina.html" o la página que desees
        header("Location: index.php?error=credenciales");
    }
    exit; // Asegura que el script se detenga después de la redirección
} else {
    // Las credenciales son incorrectas, redirige a "index.php" con un parámetro GET
    header("Location: index.php?error=credenciales");
}

// Cierra la conexión cuando hayas terminado
$conn->close();
?>

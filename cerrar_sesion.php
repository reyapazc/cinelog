<?php
// Inicia o reanuda la sesión
session_start();

// Destruye todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Redirige a la página de inicio de sesión u otra página relevante
header("Location: index.php"); // Cambia "index.php" al archivo de inicio de sesión
exit;
?>

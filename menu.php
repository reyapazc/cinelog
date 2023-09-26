<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CineLog</title>
    <link href="menu.css" rel="stylesheet">
</head>
<body>

<style>
    /* Estilos para el popup */
    .popup {
        display: none; /* El popup está oculto por defecto */
        position: fixed;
        top: 50%; /* Centra verticalmente en la pantalla */
        left: 50%; /* Centra horizontalmente en la pantalla */
        transform: translate(-50%, -50%); /* Centra perfectamente en ambas direcciones */
        background-color: #FBCF4C;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        border: 2px solid #000000; /* Borde amarillo */
        max-width: 400px;
        text-align: center;
    }

    /* Estilos para el botón de cerrar (X) */
    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }
</style>

<header>
    <img class="header-image" alt="" src="public/frame.png" />
</header>
<div class="login-box">
    <form id="generar-bitacora-form" action="generar_bitacora.php" method="POST">
        <button type="submit" class="button1">Generar Bitácora</button>
        <a href="bitacora.php" class="button2">Bitácora del Día</a>
        <a href="historial.html" class="button">Historial de Bitácora</a>
    </form>
</div>
<div class="contenido-del-sitio">
    Contenido del sitio 2023© Derechos reservados Exhibidora Mexicana Cinépolis®, S.A. de C.V.
</div>
<div id="mi-popup" class="popup">
    <?php
    if (isset($_GET['mensaje'])) {
        echo '<span id="popup-message">' . htmlspecialchars($_GET['mensaje']) . '</span>';
        echo '<br>';
        echo '<span>Cerrando en <span id="contador">3</span> segundos...</span>';
    }
    ?>
    <span id="cerrar-popup" class="close-button">X</span>
</div>
<script>
    // Función para mostrar un mensaje emergente con texto específico
    function mostrarPopup(mensaje) {
        var popup = document.getElementById("mi-popup");
        var popupMessage = document.getElementById("popup-message");
        var contador = document.getElementById("contador");
        var cerrarPopupBtn = document.getElementById("cerrar-popup");

        popupMessage.textContent = mensaje;
        popup.style.display = "block";

        // Cerrar el popup después de 3 segundos
        var segundos = 3; // Establece la cantidad de segundos
        contador.innerHTML = segundos;

        var intervalo = setInterval(function() {
            segundos--;
            contador.innerHTML = segundos;

            if (segundos <= 0) {
                clearInterval(intervalo); // Detiene el contador cuando alcanza 0
                popup.style.display = "none"; // Oculta el popup
            }
        }, 1000); // Actualiza el contador cada segundo

        // Agregar evento clic para cerrar el popup
        cerrarPopupBtn.onclick = function() {
            popup.style.display = "none";
        };
    }
</script>
</body>
</html>

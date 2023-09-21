<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cinelog</title>
  <link href="index.css" rel="stylesheet">
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
</head>
<body>
  <header>
    <!-- Encabezado -->
    <img class="header-image" alt="" src="public/frame.png" />
  </header>
  <div id="alerta" class="alerta-invisible"></div> <!-- Div para mostrar la alerta -->
  <div class="login-box">
    <form class="login-form" action="procesar_login.php" method="POST">
      <label>
        <input type="text" placeholder="Nombre de usuario" name="usuario" />
      </label>
      <label>
        <input type="password" placeholder="Contraseña" name="contraseña" />
      </label>
      <button type="submit" class="button">Acceder</button>
    </form>
    
    <!-- Agrega el HTML para el popup -->
    <div id="mi-popup" class="popup">
      <div class="popup-content">
        <span class="close-button" id="cerrar-popup">&times;</span> <!-- Botón para cerrar (X) -->
        <p class="error-message centered-message">¡Verifica tus credenciales!</p>
        <!-- Contador de segundos -->
        <div id="contador">3</div> <!-- Contador inicializado en 5 segundos -->
      </div>
    </div>
    
  </div>
  <div class="contenido-del-sitio">
    Contenido del sitio 2023© Derechos reservados Exhibidora Mexicana Cinépolis®, S.A. de C.V.
  </div>

  <script>
    // JavaScript para mostrar y ocultar el popup
<?php
  if (isset($_GET['error']) && $_GET['error'] == 'credenciales') {
    echo 'document.getElementById("mi-popup").style.display = "block";';
    echo 'var segundos = 3;'; // Establece la cantidad de segundos
    echo 'var contador = document.getElementById("contador");';

    echo 'var intervalo = setInterval(function() {';
    echo '  segundos--;';
    echo '  contador.innerHTML = segundos;';

    echo '  if (segundos <= 0) {';
    echo '    clearInterval(intervalo);'; // Detiene el contador cuando alcanza 0
    echo '    document.getElementById("mi-popup").style.display = "none";'; // Oculta el popup
    echo '  }';
    echo '}, 1000);'; // Actualiza el contador cada segundo
  }
  ?>

  // Cerrar el popup cuando se hace clic en la (X)
  var cerrarPopupBtn = document.getElementById("cerrar-popup");
  cerrarPopupBtn.onclick = function() {
    document.getElementById("mi-popup").style.display = "none";
  }
  </script>
</body>
</html>

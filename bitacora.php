<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./bitacora.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
    <title>Bitácora</title>
</head>
<body style="background-color: #002069">
<script>
    // Función para agregar una nueva fila a la tabla
    function agregarFila() {
        // Obtén los valores ingresados en el formulario
        const numeroSala = document.getElementsByName("numero_sala")[0].value;
        const horaFuncion = document.getElementsByName("hora_funcion")[0].value;
        const clientesSala = document.getElementsByName("clientes_sala")[0].value;
        const boletosVendidos = document.getElementsByName("boletos_vendidos")[0].value;
        const cortesiasGeneradas = document.getElementsByName("cortesias_generadas")[0].value;
        const responsableConteo = document.getElementsByName("responsable_conteo")[0].value;
        const responsableSala = document.getElementsByName("responsable_sala")[0].value;

        // Obtén la tabla
        const tabla = document.getElementById("bitacoraTable").getElementsByTagName("tbody")[0];

        // Crea una nueva fila y agrega celdas con los valores ingresados
        const nuevaFila = document.createElement("tr");
        nuevaFila.innerHTML = `
            <td>${numeroSala}</td>
            <td>${horaFuncion}</td>
            <td>${clientesSala}</td>
            <td>${boletosVendidos}</td>
            <td>${cortesiasGeneradas}</td>
            <td>${responsableConteo}</td>
            <td>${responsableSala}</td>
            <td>
                <button onclick="editarFila(this.parentElement.parentElement)">Editar</button>
                <button onclick="eliminarFila(this.parentElement.parentElement)">Eliminar</button>
            </td>
        `;

        // Agrega la nueva fila a la tabla
        tabla.appendChild(nuevaFila);

        // Limpia los campos del formulario
        document.getElementById("bitacoraForm").reset();

        // Enviar los datos al servidor (PHP) para guardar en la base de datos
        guardarEnBaseDeDatos(numeroSala, horaFuncion, clientesSala, boletosVendidos, cortesiasGeneradas, responsableConteo, responsableSala);
    }

    // Función para enviar datos al servidor (PHP) para guardar en la base de datos
    function guardarEnBaseDeDatos(numeroSala, horaFuncion, clientesSala, boletosVendidos, cortesiasGeneradas, responsableConteo, responsableSala) {
        // Crear un objeto XMLHttpRequest para realizar una solicitud AJAX
        const xhr = new XMLHttpRequest();
        const url = "guardar_datos.php"; // Ruta al archivo PHP que manejará el guardado en la base de datos
        const params = `numero_sala=${numeroSala}&hora_funcion=${horaFuncion}&clientes_sala=${clientesSala}&boletos_vendidos=${boletosVendidos}&cortesias_generadas=${cortesiasGeneradas}&responsable_conteo=${responsableConteo}&responsable_sala=${responsableSala}`;

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Aquí puedes manejar la respuesta del servidor si es necesario
                console.log(xhr.responseText);
            }
        };

        // Enviar la solicitud al servidor
        xhr.send(params);
    }
// Variable global para almacenar el ID de la fila en edición
let filaEditadaId = null;

    // Función para habilitar la edición de una fila
    function editarFila(fila) {
        const celdas = fila.getElementsByTagName('td');

        // Comprueba si esta fila ya está en modo de edición
        if (fila.getAttribute('data-editable') === 'true') {
            // Si está en modo de edición, guardar los cambios
            guardarFila(fila);
        } else {
            // Si no está en modo de edición, habilitar la edición
            fila.setAttribute('data-editable', 'true');

            // Itera a través de las celdas y reemplaza el contenido con campos de entrada
            for (let i = 0; i < celdas.length - 1; i++) {
                const input = document.createElement('input');
                input.type = 'text';
                input.value = celdas[i].textContent;
                celdas[i].textContent = '';
                celdas[i].appendChild(input);
            }

            // Cambia el tipo del botón de "Editar" a "Guardar"
            const botonEditar = celdas[celdas.length - 1].querySelector('button');
            botonEditar.innerHTML = 'Guardar';
        }
    }

    // Función para guardar los cambios en una fila editada
    function guardarFila(fila) {
        const celdas = fila.getElementsByTagName('td');

        // Recopila los valores editados de los campos de entrada
        const valoresEditados = [];
        for (let i = 0; i < celdas.length - 1; i++) {
            const input = celdas[i].querySelector('input');
            valoresEditados.push(input.value);
            celdas[i].textContent = input.value;
        }

        // Cambia el tipo del botón de "Guardar" a "Editar"
        const botonEditar = celdas[celdas.length - 1].querySelector('button');
        botonEditar.innerHTML = 'Editar';
        fila.removeAttribute('data-editable');

        // Aquí puedes enviar los valores editados al servidor si es necesario
    }

    // Función para eliminar una fila
    function eliminarFila(fila) {
        const tabla = document.getElementById('bitacoraTable').getElementsByTagName('tbody')[0];
        tabla.removeChild(fila);

        // Aquí puedes enviar una solicitud al servidor para eliminar la fila de la base de datos si es necesario
    }
</script>

<header>
    <img class="header-image" alt="" src="./public/frame1.png" />
</header>
<div class="bitacora">
    <!-- Parte de arriba con 7 textos, 7 inputs y un botón -->
    <form id="bitacoraForm" method="post" action="guardar_datos.php">
        <div class="form-row-container">
            <div class="form-row">
                <label>Número de sala:</label>
                <input type="text" name="numero_sala">
            </div>
            <div class="form-row">
                <label>Hora de la función:</label>
                <input type="text" name="hora_funcion">
            </div>
        </div>

        <div class="form-row-container">
            <div class="form-row">
                <label>Número de clientes en sala:</label>
                <input type="text" name="clientes_sala">
            </div>
            <div class="form-row">
                <label>Boletos vendidos en sistema:</label>
                <input type="text" name="boletos_vendidos">
            </div>
        </div>

        <div class="form-row-container">
            <div class="form-row">
                <label>Cortesías generadas en sistema:</label>
                <input type="text" name="cortesias_generadas">
            </div>
            <div class="form-row">
                <label>Responsable de conteo:</label>
                <input type="text" name="responsable_conteo">
            </div>
        </div>

        <div class="form-row-container">
            <div class="form-row">
                <label>Responsable de sala:</label>
                <input type="text" name="responsable_sala">
            </div>
            <div class="button-container">
                <!-- Cambia el tipo de botón a "button" y agrega un evento onclick para manejar el formulario -->
                <button type="button" onclick="agregarFila()">Guardar</button>
            </div>
        </div>
    </form>

    <!-- Parte de abajo con la tabla scrollable -->
    <div class="scrollable-table">
        <table id="bitacoraTable">
            <thead>
            <tr>
                <th>Número de sala:</th>
                <th>Hora de la función:</th>
                <th>Número de clientes en sala:</th>
                <th>Boletos vendidos en sistema:</th>
                <th>Cortesías generadas en sistema:</th>
                <th>Responsable de conteo:</th>
                <th>Responsable de sala:</th>
                <th></th> <!-- Nueva columna para los botones -->
            </tr>
            </thead>

            <tbody>
            <!-- Aquí se generarán dinámicamente las filas de la tabla -->
            </tbody>
        </table>
    </div>
</div>

<footer>
    <p>
        Contenido del sitio 2023© Derechos reservados Exhibidora Mexicana Cinépolis®, S.A. de C.V.
    </p>
</footer>
</body>
</html>

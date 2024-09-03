<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Establece el tipo de documento como HTML5 -->
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Hace que la página sea responsiva -->
    <title>Conversor de Bases</title> <!-- Título de la página -->

    <!-- Estilos internos para el diseño de la página -->
    <style>
        body {
            font-family: Arial, sans-serif; /* Fuente utilizada en la página */
            background-color: #f2e7f7; /* Color de fondo de la página */
            display: flex; /* Utiliza flexbox para centrar el contenido */
            justify-content: center; /* Centra horizontalmente el contenido */
            align-items: center; /* Centra verticalmente el contenido */
            height: 100vh; /* Altura completa de la ventana */
            margin: 0; /* Elimina los márgenes predeterminados */
        }
        .container {
            background-color: #fff; /* Fondo blanco para el contenedor */
            padding: 20px; /* Espaciado interno del contenedor */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 0 15px rgba(0, 0, 0, 1); /* Sombra para el contenedor */
            width: 350px; /* Ancho fijo del contenedor */
            text-align: center; /* Centra el texto dentro del contenedor */
        }
        input[type="text"] {
            width: 95%; /* Ancho del campo de entrada */
            padding: 10px; /* Espaciado interno del campo de entrada */
            margin: 10px 0; /* Espaciado vertical del campo de entrada */
            border: 1px solid #ccc; /* Borde del campo de entrada */
            border-radius: 4px; /* Bordes redondeados del campo de entrada */
        }
        select {
            width: 100%; /* Ancho completo para el menú desplegable */
            padding: 10px; /* Espaciado interno del menú desplegable */
            margin: 10px 0; /* Espaciado vertical del menú desplegable */
            border: 1px solid #ccc; /* Borde del menú desplegable */
            border-radius: 4px; /* Bordes redondeados del menú desplegable */
        }
        input[type="submit"] {
            background-color: #28a745; /* Color de fondo del botón */
            color: #fff; /* Color del texto en el botón */
            border: none; /* Elimina el borde predeterminado del botón */
            padding: 10px; /* Espaciado interno del botón */
            border-radius: 4px; /* Bordes redondeados del botón */
            cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
        }
        input[type="submit"]:hover {
            background-color: #218838; /* Color de fondo al pasar el cursor por encima del botón */
        }
        .result {
            margin-top: 20px; /* Espaciado superior para el resultado */
            font-weight: bold; /* Hace que el resultado se vea en negritas */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Conversor de Bases</h2> <!-- Título principal del formulario -->

        <!-- Formulario para ingresar el número y seleccionar la conversión -->
        <form method="post"> <!-- El método POST envía los datos del formulario de forma oculta -->
            <input type="text" name="number" placeholder="Ingresa un número" required> <!-- Campo de entrada para el número -->
            <select name="conversion"> <!-- Menú desplegable para seleccionar el tipo de conversión -->
                <option value="octal_to_decimal">Base 8 a Base 10</option> <!-- Opción para convertir de base 8 a base 10 -->
                <option value="decimal_to_octal">Base 10 a Base 8</option> <!-- Opción para convertir de base 10 a base 8 -->
                <option value="decimal_to_hex">Base 10 a Base 16</option> <!-- Opción para convertir de base 10 a base 16 -->
                <option value="hex_to_decimal">Base 16 a Base 10</option> <!-- Opción para convertir de base 16 a base 10 -->
            </select>
            <input type="submit" value="Convertir"> <!-- Botón para enviar el formulario -->
        </form>

        <?php
        // Comprueba si el formulario fue enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $number = $_POST["number"]; // Obtiene el número ingresado en el formulario
            $conversion = $_POST["conversion"]; // Obtiene la conversión seleccionada en el formulario
            $result = ""; // Inicializa la variable de resultado

            // Realiza la conversión según la opción seleccionada
            switch ($conversion) {
                case "octal_to_decimal":
                    // Convertir de base 8 a base 10
                    if (!ctype_digit($number) || preg_match('/[89]/', $number)) { // Verifica que el número sea válido en base 8
                        $result = "Error: El número proporcionado no es válido en base 8."; // Mensaje de error si no es válido
                    } else {
                        $result = octdec($number); // Convierte el número de base 8 a base 10
                    }
                    break;

                case "decimal_to_octal":
                    // Convertir de base 10 a base 8
                    if (!ctype_digit($number)) { // Verifica que el número sea válido en base 10
                        $result = "Error: El número proporcionado no es válido en base 10."; // Mensaje de error si no es válido
                    } else {
                        $result = decoct((int)$number); // Convierte el número de base 10 a base 8
                    }
                    break;

                case "decimal_to_hex":
                    // Convertir de base 10 a base 16
                    if (!ctype_digit($number)) { // Verifica que el número sea válido en base 10
                        $result = "Error: El número proporcionado no es válido en base 10."; // Mensaje de error si no es válido
                    } else {
                        $result = dechex((int)$number); // Convierte el número de base 10 a base 16
                    }
                    break;

                case "hex_to_decimal":
                    // Convertir de base 16 a base 10
                    if (!ctype_xdigit($number)) { // Verifica que el número sea válido en base 16
                        $result = "Error: El número proporcionado no es válido en base 16."; // Mensaje de error si no es válido
                    } else {
                        $result = hexdec($number); // Convierte el número de base 16 a base 10
                    }
                    break;

                default:
                    $result = "Error: Selección de conversión no válida."; // Mensaje de error si la conversión no es válida
                    break;
            }

            // Muestra el resultado de la conversión
            echo "<div class='result'>Resultado: $result</div>";
        }
        ?>
    </div>
</body>
</html>

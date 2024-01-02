<?php

function validarPeticion() {
    // Obtiene el encabezado User-Agent de la solicitud
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    // Lista de cadenas comunes en el User-Agent de navegadores
    $navegadores = array(
        'Mozilla', 'Firefox', 'Chrome', 'Safari', 'Opera', 'IE'
    );

    // Verifica si el User-Agent contiene alguna cadena de navegadores
    foreach ($navegadores as $navegador) {
        if (strpos($userAgent, $navegador) !== false) {
            // Es un navegador, puedes agregar aquí cualquier otra lógica que desees
            return true;
        }
    }

    // Acceso desde otro tipo de agente (posiblemente un bot)
    // Puedes manejarlo como desees, por ejemplo, redirigiendo o mostrando un mensaje
    header("HTTP/1.0 403 Forbidden");
    exit("Acceso prohibido");
}

// Llama a la función al inicio de tu script o en el punto donde desees realizar la verificación
//validarPeticion();



?>

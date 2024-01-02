<?php

function bloquearIP() {
    // Obtiene la IP del cliente
    $ipCliente = $_SERVER['REMOTE_ADDR'];

    // Conecta a la base de datos (Asegúrate de tener las credenciales correctas)
    $conexion = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_KEY, DATABASE_NAME);

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Verifica si la IP está bloqueada
    $sql = "SELECT id FROM ip_block WHERE ip_address = ? LIMIT 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $ipCliente);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // IP bloqueada, redirige a la página de error
        header("Location: pagina_error.php");
        exit();
    }

    // Recursos sensibles que deseas bloquear
    $recursosBloqueados = array("/.env", "/wp-config.php");

    // Verifica si el cliente está accediendo a un recurso bloqueado
    $recursoPedido = $_SERVER['REQUEST_URI'];

    foreach ($recursosBloqueados as $recurso) {
        if (strpos($recursoPedido, $recurso) !== false) {
            // IP bloqueada, redirige a la página de error y guarda en la base de datos
            $stmt->close();

            $sql = "INSERT INTO ip_block (ip_address, requested_resource) VALUES (?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ss", $ipCliente, $recursoPedido);
            $stmt->execute();

            header("Location: pagina_error.php");
            exit();
        }
    }

    // Cierra la conexión y el statement
    $stmt->close();
    $conexion->close();
}

// Llama a la función en cada petición
//bloquearIP();

//CREATE TABLE ip_block (
//    id INT AUTO_INCREMENT PRIMARY KEY,
//    ip_address VARCHAR(45) NOT NULL,
//    requested_resource VARCHAR(255) NOT NULL,
//    request_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//);
?>

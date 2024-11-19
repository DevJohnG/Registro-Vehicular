<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
    <link rel="stylesheet" href="registroConfirm_style.css">
</head>
<body>

<div class="confirmation-message">
<?php

include 'includes/Database.php';
include 'includes/Propietario.php';

$database = new Database();
$db = $database->getConnection();

$propietario = new Propietario($db);

$propietario->id_propietario = $_POST['id_propietario'];
$propietario->nombre_propietario = $_POST['nombre_propietario'];
$propietario->apellido_propietario = $_POST['apellido_propietario'];
$propietario->telefono_propietario = $_POST['telefono_propietario'];
$propietario->tipo_propietario = $_POST['tipo_propietario'];
$propietario->correo_propietario = $_POST['correo_propietario'];

try {
    // Intentar registrar el propietario
    if ($propietario->registrar()) {
        echo "<h1>Propietario registrado exitosamente.</h1>";
    } else {
        echo "<h1 class='error'>Error al registrar el propietario.</h1>";
    }
} catch (Exception $e) {
    // Manejo de errores
    echo "Se produjo un error: " . $e->getMessage();
}
?>
<a href="index.php">VOLVER AL MENÚ</a>
</div>
</body>
</html>

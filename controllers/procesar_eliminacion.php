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

include '../Database.php';
include '../Automovil.php';

$database = new Database();
$db = $database->getConnection();


$automovil = new Automovil($db);

if (isset($_POST['eliminar'])) {
    $placa = $_POST['placa'];
    if ($automovil->eliminar($placa)) {
        echo "Automóvil eliminado exitosamente.";
    } else {
        echo "Error al eliminar el automóvil.";
    }
}
?>
  <a href="index.php">VOLVER AL MENÚ</a>
</div>

</body>
</html>
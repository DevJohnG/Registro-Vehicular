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

// Verificamos si se ha enviado el formulario de búsqueda
if (isset($_POST['buscar'])) {
    $criterio = $_POST['criterio'];

    // Llamamos al método buscar de la clase Automovil
    $resultado = $automovil->buscar($criterio);

    if ($resultado) {
        echo "Resultados de la búsqueda: <br><br>";

        // Recorremos el resultado y mostramos los datos de cada automóvil
        foreach ($resultado as $auto) {
            echo "Propietario: " . $auto['nombre_propietario'] . " " . $auto['apellido_propietario'] . "<br>" .
                 "Marca: " . $auto['nombre_marca'] . "<br>" .
                 "Modelo: " . $auto['nombre_modelo'] . "<br>" .
                 "Año: " . $auto['anio'] . "<br>" .
                 "Placa: " . $auto['placa'] . "<br>" .
                 "Color: " . $auto['color'] . "<br>" .
                 "Número de Motor: " . $auto['num_motor'] . "<br>" .
                 "Número de Chasis: " . $auto['num_chasis'] . "<br>" .
                 "Tipo de Vehículo: " . $auto['tipo_vehiculo'] . "<br>" .
                 "Capacidad del Motor: " . $auto['capacidad_motor'] . " L<br>" .
                 "Número de Cilindros: " . $auto['num_cilindros'] . "<br>" .
                 "Tipo de Combustible: " . $auto['tipo_combustible'] . "<br>" .
                 "Peso Bruto: " . $auto['peso_bruto'] . " kg<br>" .
                 "Transmisión: " . $auto['transmision'] . "<br><br>";
        }
    } else {
        echo "No se encontró ningún automóvil con ese criterio.";
    }
}
?>
<a href="index.php">VOLVER AL MENÚ</a>
</div>

</body>
</html>

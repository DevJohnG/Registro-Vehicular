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

    if (!empty($_POST['id_propietario']) && !empty($_POST['id_marca']) && !empty($_POST['id_modelo']) && 
    !empty($_POST['anio']) && !empty($_POST['color']) && !empty($_POST['placa']) && 
    !empty($_POST['num_motor']) && !empty($_POST['num_chasis']) && !empty($_POST['tipo_vehiculo'])) {

    $automovil->id_propietario = $_POST['id_propietario'];
    $automovil->id_marca = $_POST['id_marca'];
    $automovil->id_modelo = $_POST['id_modelo'];
    $automovil->anio = $_POST['anio'];
    $automovil->color = $_POST['color'];
    $automovil->placa = $_POST['placa'];
    $automovil->num_motor = $_POST['num_motor'];
    $automovil->num_chasis = $_POST['num_chasis'];
    $automovil->tipo_vehiculo = $_POST['tipo_vehiculo'];

} else {
    echo "<h1 class='error'>Error: Todos los campos son obligatorios.</h1>";
}


    try {
        if ($automovil->registrar()) {
            echo "<h1>Automóvil registrado exitosamente.</h1>";
            echo "<p>El registro del automóvil se ha completado con éxito.</p>";
        } else {
            echo "<h1 class='error'>Error al registrar el automóvil.</h1>";
            echo "<p>Hubo un problema al intentar registrar el automóvil. Por favor, intente de nuevo.</p>";
        }
    } catch (PDOException $e) {
        echo "<h1 class='error'>Error en la base de datos.</h1>";
        echo "<p>Detalle del error: " . $e->getMessage() . "</p>";
    }
    ?>
    <a href="index.php">VOLVER AL MENÚ</a>
</div>

</body>
</html>

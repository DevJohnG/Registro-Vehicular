<?php

include '../Database.php';
include '../Automovil.php';

$database = new Database();
$db = $database->getConnection();

$automovil = new Automovil($db);

if (isset($_POST['actualizar'])) {
    $automovil->id_marca = $_POST['id_marca']; // Cambié de marca a id_marca
    $automovil->id_modelo = $_POST['id_modelo']; // Cambié de modelo a id_modelo
    $automovil->anio = $_POST['anio'];
    $automovil->color = $_POST['color'];
    $automovil->placa = $_POST['placa'];
    $automovil->num_motor = $_POST['num_motor'];
    $automovil->num_chasis = $_POST['num_chasis'];
    $automovil->id_tipovehiculo = $_POST['id_tipovehiculo']; // Cambié de tipo_auto a id_tipovehiculo
    $automovil->id_propietario = $_POST['id_propietario'];

    // Verifica si la placa existe
    if ($automovil->placaExiste()) {
        // Actualiza el automóvil
        if ($automovil->actualizar()) {
            header("Location: actualizar_automovil.php?status=success");
            exit();
        } else {
            header("Location: actualizar_automovil.php?status=update_error");
            exit();
        }
    } else {
        header("Location: actualizar_automovil.php?status=placa_no_existe");
        exit();
    }
}
?>

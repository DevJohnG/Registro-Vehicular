<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="actualizarAuto_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Actualizar Automóvil</title>
</head>
<body>

<header>
    <img src="https://img.freepik.com/vector-gratis/coche-sedan-rojo-aislado-vector-blanco_53876-67411.jpg?t=st=1725490616~exp=1725494216~hmac=6f7b7da3ccf5a6db9f2ad36">
    <h2>ACTUALIZAR AUTOMOVIL</h2>
</header>

<section class="mainCont">

<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'placa_no_existe') {
        echo '<h1 class="error">La placa ingresada no existe en la base de datos.</h1>';
    } elseif ($_GET['status'] == 'success') {
        echo '<h1 class="success">Automóvil actualizado exitosamente.</h1>';
    } elseif ($_GET['status'] == 'update_error') {
        echo '<h1 class="error">Hubo un problema al actualizar el automóvil.</h1>';
    }
}
?>

<form action="procesar_actualizacion.php" method="post" novalidate>
    <label for="id_marca">Marca:</label>
    <select id="id_marca" name="id_marca" required>
        <option value="">Seleccione una marca</option>
        <?php
        include 'includes/Database.php';
        $database = new Database();
        $db = $database->getConnection();
        $query = "SELECT id_marca, nombre_marca FROM marcas";
        $stmt = $db->prepare($query);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id_marca']}'>{$row['nombre_marca']}</option>";
        }
        ?>
    </select>

    <label for="id_modelo">Modelo:</label>
    <select id="id_modelo" name="id_modelo" required>
        <option value="">Seleccione un modelo</option>
    </select>

    <label for="anio">Año:</label>
    <input type="number" id="anio" name="anio" min="1990" max="2025" required>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color" required>  

    <label for="placa">Placa:</label>
    <input type="text" id="placa" name="placa" required>

    <label for="num_motor">Número de motor:</label>
    <input type="text" id="num_motor" name="num_motor" required>

    <label for="num_chasis">Número de Chasis:</label>
    <input type="text" id="num_chasis" name="num_chasis" required>

    <label for="id_tipovehiculo">Tipo de auto:</label>
    <select id="id_tipovehiculo" name="id_tipovehiculo" required>
        <?php
        $query = "SELECT id_tipovehiculo, tipo_vehiculo FROM tipos_vehiculos";
        $stmt = $db->prepare($query);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id_tipovehiculo']}'>{$row['tipo_vehiculo']}</option>";
        }
        ?>
    </select>

    <label for="id_propietario">ID de Propietario:</label>
    <select id="id_propietario" name="id_propietario" required>
        <option value="">Seleccione un propietario</option>
        <?php
        $query = "SELECT id_propietario, nombre_propietario, apellido_propietario FROM propietarios";
        $stmt = $db->prepare($query);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id_propietario']}'>{$row['nombre_propietario']} {$row['apellido_propietario']}</option>";
        }
        ?>
    </select>

    <br>

    <input type="submit" value="Actualizar">
</form>
</section>

<script>
$(document).ready(function() {
    $('#id_marca').change(function() {
        var id_marca = $(this).val();
        if (id_marca != '') {
            $.ajax({
                type: 'POST',
                url: 'obtener_modelos.php',
                data: {id_marca: id_marca},
                dataType: 'json',
                success: function(data) {
                    $('#id_modelo').empty();
                    $('#id_modelo').append('<option value="">Seleccione un modelo</option>');
                    $.each(data, function(index, modelo) {
                        $('#id_modelo').append('<option value="' + modelo.id_modelo + '">' + modelo.nombre_modelo + '</option>');
                    });
                }
            });
        } else {
            $('#id_modelo').empty();
            $('#id_modelo').append('<option value="">Seleccione un modelo</option>');
        }
    });
});
</script>

</body>
</html>

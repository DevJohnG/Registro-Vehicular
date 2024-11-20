<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registrarAuto_style.css">
    <title>Registro de Automóviles</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<header>
    <img src="https://img.freepik.com/vector-gratis/coche-sedan-rojo-aislado-vector-blanco_53876-67411.jpg?t=st=1725490616~exp=1725494216~hmac=6f7b7da3ccf5a6db9f2ad36763e96aa20f255c2e18dffaaa6d4442e1772e62e5&w=740" alt="Coche">
    <h2>REGISTRAR AUTOMÓVIL</h2>
</header>

<section class="mainCont">
    <form action="procesar_registro.php" method="post">
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

        <label for="tipo_vehiculo">Tipo de auto:</label>
        <input type="text" id="tipo_vehiculo" name="tipo_vehiculo" readonly>

        <label for="id_propietario">Propietario (ID):</label>
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

        <input type="submit" value="Registrar">
    </form>
</section>

<script>
$(document).ready(function() {
    $('#id_marca').change(function() {
        var id_marca = $(this).val();
        $('#tipo_vehiculo').val(''); 
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

    $('#id_modelo').change(function() {
    var id_modelo = $(this).val();
    if (id_modelo != '') {
        $.ajax({
            type: 'POST',
            url: 'obtener_tipovehiculo.php', // Crea este archivo para obtener el tipo
            data: {id_modelo: id_modelo},
            dataType: 'json',
            success: function(data) {
               $('#tipo_vehiculo').val(data.tipo_vehiculo); // Actualiza el ID correcto
            }
        });
    } else {
        $('tipo_vehiculo').val(''); // Limpiar el campo si no hay modelo seleccionado
    }
});

});

</script>
</body>
</html>

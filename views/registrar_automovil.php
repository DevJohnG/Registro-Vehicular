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
    <form action="/controllers/procesar_registro.php" method="post">
        <!-- Campos básicos -->
        <label for="vin">VIN:</label>
        <input type="text" id="vin" name="vin" maxlength="17" required>

        <label for="placa">Placa:</label>
        <input type="text" id="placa" name="placa" required>

        <label for="id_marca">Marca:</label>
        <select id="id_marca" name="id_marca" required>
            <option value="">Seleccione una marca</option>
            <?php
include __DIR__ . '/../config/Database.php';

try {
    $database = new Database();
    $db = $database->getConnection();
} catch (Exception $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
    exit; // Detiene el script si no se puede conectar
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

        <!-- Nuevos campos según la base de datos -->
        <label for="id_tipovehiculo">Tipo de Vehículo:</label>
        <select id="id_tipovehiculo" name="id_tipovehiculo" required>
            <option value="">Seleccione un tipo</option>
            <?php
            $query = "SELECT id_tipovehiculo, tipo_vehiculo FROM tipos_vehiculos";
            $stmt = $db->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id_tipovehiculo']}'>{$row['tipo_vehiculo']}</option>";
            }
            ?>
        </select>

        <label for="capacidad_motor">Capacidad del Motor:</label>
        <input type="text" id="capacidad_motor" name="capacidad_motor">

        <label for="num_cilindros">Número de Cilindros:</label>
        <input type="number" id="num_cilindros" name="num_cilindros">

        <label for="tipo_combustible">Tipo de Combustible:</label>
        <select id="tipo_combustible" name="tipo_combustible" required>
            <option value="">Seleccione un tipo</option>
            <option value="Gasolina">Gasolina</option>
            <option value="Diésel">Diésel</option>
            <option value="Eléctrico">Eléctrico</option>
            <option value="Híbrido">Híbrido</option>
        </select>

        <label for="peso_bruto">Peso Bruto (kg):</label>
        <input type="number" id="peso_bruto" name="peso_bruto" step="0.01">

        <label for="transmision">Transmisión:</label>
        <select id="transmision" name="transmision" required>
            <option value="">Seleccione</option>
            <option value="Manual">Manual</option>
            <option value="Automática">Automática</option>
        </select>

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
// Scripts para modelos dinámicos
$(document).ready(function() {
    $('#id_marca').change(function() {
        var id_marca = $(this).val();
        if (id_marca != '') {
            $.ajax({
                type: 'POST',
                url: '/controllers/obtener_modelos.php',
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

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

    // Validamos si todos los datos requeridos están presentes
    if (
        !empty($_POST['id_propietario']) && ctype_digit($_POST['id_propietario']) &&
        !empty($_POST['id_marca']) && ctype_digit($_POST['id_marca']) &&
        !empty($_POST['id_modelo']) && ctype_digit($_POST['id_modelo']) &&
        !empty($_POST['anio']) && ctype_digit($_POST['anio']) &&
        !empty($_POST['color']) &&
        !empty($_POST['placa']) &&
        !empty($_POST['id_tipovehiculo']) && ctype_digit($_POST['id_tipovehiculo']) &&
        !empty($_POST['capacidad_motor']) &&
        !empty($_POST['num_cilindros']) && ctype_digit($_POST['num_cilindros']) &&
        !empty($_POST['tipo_combustible']) &&
        !empty($_POST['peso_bruto']) && is_numeric($_POST['peso_bruto']) &&
        !empty($_POST['transmision'])
    ) {
        // Asignamos los valores a las propiedades de la clase Automovil
        $automovil->id_propietario = htmlspecialchars(strip_tags($_POST['id_propietario']));
        $automovil->id_marca = htmlspecialchars(strip_tags($_POST['id_marca']));
        $automovil->id_modelo = htmlspecialchars(strip_tags($_POST['id_modelo']));
        $automovil->anio = htmlspecialchars(strip_tags($_POST['anio']));
        $automovil->color = htmlspecialchars(strip_tags($_POST['color']));
        $automovil->placa = htmlspecialchars(strip_tags($_POST['placa']));
        $automovil->id_tipovehiculo = htmlspecialchars(strip_tags($_POST['id_tipovehiculo']));
        $automovil->capacidad_motor = htmlspecialchars(strip_tags($_POST['capacidad_motor']));
        $automovil->num_cilindros = htmlspecialchars(strip_tags($_POST['num_cilindros']));
        $automovil->tipo_combustible = htmlspecialchars(strip_tags($_POST['tipo_combustible']));
        $automovil->peso_bruto = htmlspecialchars(strip_tags($_POST['peso_bruto']));
        $automovil->transmision = htmlspecialchars(strip_tags($_POST['transmision']));

        // Intentamos registrar el automóvil
        try {
            if ($automovil->registrar()) {
                echo "<h1 class='success'>Automóvil registrado exitosamente.</h1>";
                echo "<p>El registro del automóvil se ha completado con éxito.</p>";
            } else {
                throw new Exception("Hubo un problema al intentar registrar el automóvil. Por favor, intente de nuevo.");
            }
        } catch (Exception $e) {
            echo "<h1 class='error'>Error al registrar el automóvil.</h1>";
            echo "<p>" . $e->getMessage() . "</p>";
        } catch (PDOException $e) {
            echo "<h1 class='error'>Error en la base de datos.</h1>";
            echo "<p>Detalle del error: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<h1 class='error'>Error: Todos los campos son obligatorios y deben ser válidos.</h1>";
    }
    ?>
    <a href="../index.php">VOLVER AL MENÚ</a>
</div>

</body>
</html>

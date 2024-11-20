<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registrarAuto_style.css">
    <title>Registro de Propietarios</title>
</head>

<body>

<header>

<img src="https://img.freepik.com/vector-gratis/coche-sedan-rojo-aislado-vector-blanco_53876-67411.jpg?t=st=1725490616~exp=1725494216~hmac=6f7b7da3ccf5a6db9f2ad36763e96aa20f255c2e18dffaaa6d4442e1772e62e5&w=740">
<h2>REGISTRAR PROPIETARIO</h2>

</header>

<section class="mainCont">
    
    <form action="procesar_registroPropietario.php" method="post">
        <label for="id_propietario">Cédula o Identificación:</label>
        <input type="text" id="id_propietario" name="id_propietario" required>

        <label for="nombre_propietario">Nombre:</label>
        <input type="text" id="nombre_propietario" name="nombre_propietario" required>

        <label for="apellido_propietario">Apellido:</label>
        <input type="text" id="apellido_propietario" name="apellido_propietario" required>

        <label for="telefono_propietario">Teléfono:</label>
        <input type="text" id="telefono_propietario" name="telefono_propietario" required>  

        <label for="tipo_propietario">Tipo de Propietario:</label>
        <select id="tipo_propietario" name="tipo_propietario" required>
            <option value="Natural">Natural</option>
            <option value="Jurídico">Jurídico</option>
        </select>

        <label for="correo_propietario">Correo:</label>
        <input type="text" id="correo_propietario" name="correo_propietario" required>
        
            <br>

        <input type="submit" value="Registrar">

    </form>

</section>
</body>
</html>

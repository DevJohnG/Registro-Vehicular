<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="buscarAuto_style.css">
    <title>Buscar Automóvil</title>
</head>
<body>

<header>
    <img src="https://img.freepik.com/vector-gratis/coche-sedan-rojo-aislado-vector-blanco_53876-67411.jpg?t=st=1725490616~exp=1725494216~hmac=6f7b7da3ccf5a6db9f2ad36763e96aa20f255c2e18dffaaa6d4442e1772e62e5&w=740" alt="Imagen de automóvil">
    <h2>BUSCAR AUTOMÓVIL</h2>
</header>

<section class="mainCont">
    <!-- El formulario está correctamente cerrado ahora -->
    <form method="POST" action="procesar_busqueda.php">
        <label for="criterio">Placa del automóvil:</label>
        <input type="text" name="criterio" id="criterio" required>
        <input type="submit" name="buscar" value="Buscar">
    </form>
</section>

<footer>
    <h3>John Grant</h3>
    <h3>8-983-1525</h3>
    <h3>1LS131</h3>
</footer>

</body>
</html>

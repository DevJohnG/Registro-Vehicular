<?php
include 'includes/Database.php';
$database = new Database();
$db = $database->getConnection();

if(isset($_POST['id_marca'])) {
    $id_marca = $_POST['id_marca'];
    $query = "SELECT m.id_modelo, m.nombre_modelo, t.tipo_vehiculo 
              FROM modelos m 
              JOIN tipos_vehiculos t ON m.id_tipovehiculo = t.id_tipovehiculo 
              WHERE m.id_marca = :id_marca";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_marca', $id_marca);
    $stmt->execute();

    $modelos = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $modelos[] = $row;
    }
    echo json_encode($modelos);
}
?>
<?php
include 'includes/Database.php';
$database = new Database();
$db = $database->getConnection();

if(isset($_POST['id_modelo'])) {
    $id_modelo = $_POST['id_modelo'];
    $query = "SELECT t.tipo_vehiculo 
              FROM modelos m 
              JOIN tipos_vehiculos t ON m.id_tipovehiculo = t.id_tipovehiculo 
              WHERE m.id_modelo = :id_modelo";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_modelo', $id_modelo);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);
}
?>

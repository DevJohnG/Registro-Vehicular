<?php
class Automovil {
    private $conn;
    private $table_name = "automoviles";

    public $id;
    public $id_marca; 
    public $id_modelo;
    public $anio;
    public $color;
    public $placa;
    public $num_motor;
    public $num_chasis;
    public $tipo_vehiculo;
    public $id_propietario;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar() {

        $query = "INSERT INTO " . $this->table_name . " 
                  (id_marca, id_modelo, anio, color, placa, num_motor, num_chasis, id_tipovehiculo, id_propietario) 
                  VALUES (:id_marca, :id_modelo, :anio, :color, :placa, :num_motor, :num_chasis, 
                  (SELECT id_tipovehiculo FROM tipos_vehiculos WHERE tipo_vehiculo = :tipo_vehiculo), :id_propietario)";
        
        $stmt = $this->conn->prepare($query);
    
        $this->id_marca = htmlspecialchars(strip_tags($this->id_marca));
        $this->id_modelo = htmlspecialchars(strip_tags($this->id_modelo));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->num_motor = htmlspecialchars(strip_tags($this->num_motor));
        $this->num_chasis = htmlspecialchars(strip_tags($this->num_chasis));
        $this->tipo_vehiculo = htmlspecialchars(strip_tags($this->tipo_vehiculo));
        $this->id_propietario = htmlspecialchars(strip_tags($this->id_propietario));
    
        $stmt->bindParam(":id_marca", $this->id_marca);
        $stmt->bindParam(":id_modelo", $this->id_modelo);
        $stmt->bindParam(":anio", $this->anio);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":num_motor", $this->num_motor);
        $stmt->bindParam(":num_chasis", $this->num_chasis);
        $stmt->bindParam(":tipo_vehiculo", $this->tipo_vehiculo);
        $stmt->bindParam(":id_propietario", $this->id_propietario);
    
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    

    public function buscar($criterio) {
        $query = "
            SELECT 
                a.placa, 
                a.anio, 
                a.color, 
                a.num_motor, 
                a.num_chasis,
                p.nombre_propietario, 
                p.apellido_propietario, 
                m.nombre_marca, 
                mo.nombre_modelo, 
                t.tipo_vehiculo
            FROM automoviles a
            JOIN propietarios p ON a.id_propietario = p.id_propietario
            JOIN marcas m ON a.id_marca = m.id_marca
            JOIN modelos mo ON a.id_modelo = mo.id_modelo
            JOIN tipos_vehiculos t ON a.id_tipovehiculo = t.id_tipovehiculo
            WHERE a.placa LIKE ?";
            
        $stmt = $this->conn->prepare($query);
        $criterio = "%$criterio%";
        $stmt->bindParam(1, $criterio);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($placa) {
        $query = "DELETE FROM automoviles WHERE placa = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $placa);
        return $stmt->execute();
    }

    public function placaExiste() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE placa = :placa LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":placa", $this->placa);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " 
                  SET id_marca = :id_marca, 
                      id_modelo = :id_modelo, 
                      anio = :anio, 
                      color = :color, 
                      num_motor = :num_motor, 
                      num_chasis = :num_chasis, 
                      id_tipovehiculo = :id_tipovehiculo, 
                      id_propietario = :id_propietario 
                  WHERE placa = :placa";
    
        $stmt = $this->conn->prepare($query);
        
        // Limpiar y preparar los datos
        $this->id_marca = htmlspecialchars(strip_tags($this->id_marca));
        $this->id_modelo = htmlspecialchars(strip_tags($this->id_modelo));
        $this->anio = htmlspecialchars(strip_tags($this->anio));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->placa = htmlspecialchars(strip_tags($this->placa));
        $this->num_motor = htmlspecialchars(strip_tags($this->num_motor));
        $this->num_chasis = htmlspecialchars(strip_tags($this->num_chasis));
        $this->id_tipovehiculo = htmlspecialchars(strip_tags($this->id_tipovehiculo)); // Asegúrate de usar el mismo nombre
        $this->id_propietario = htmlspecialchars(strip_tags($this->id_propietario));
    
        // Vincular los parámetros
        $stmt->bindParam(":id_marca", $this->id_marca);
        $stmt->bindParam(":id_modelo", $this->id_modelo);
        $stmt->bindParam(":anio", $this->anio);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":num_motor", $this->num_motor);
        $stmt->bindParam(":num_chasis", $this->num_chasis);
        $stmt->bindParam(":id_tipovehiculo", $this->id_tipovehiculo); // Este debe coincidir con el nombre en el query
        $stmt->bindParam(":id_propietario", $this->id_propietario);
        
        return $stmt->execute();
    }
    

}
?>

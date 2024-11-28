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
        $query = "INSERT INTO automoviles 
                  (id_propietario, id_marca, id_modelo, anio, color, placa, num_motor, num_chasis, id_tipovehiculo, capacidad_motor, num_cilindros, tipo_combustible, peso_bruto, transmision) 
                  VALUES 
                  (:id_propietario, :id_marca, :id_modelo, :anio, :color, :placa, :num_motor, :num_chasis, :id_tipovehiculo, :capacidad_motor, :num_cilindros, :tipo_combustible, :peso_bruto, :transmision)";
                  
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':id_propietario', $this->id_propietario);
        $stmt->bindParam(':id_marca', $this->id_marca);
        $stmt->bindParam(':id_modelo', $this->id_modelo);
        $stmt->bindParam(':anio', $this->anio);
        $stmt->bindParam(':color', $this->color);
        $stmt->bindParam(':placa', $this->placa);
        $stmt->bindParam(':num_motor', $this->num_motor);
        $stmt->bindParam(':num_chasis', $this->num_chasis);
        $stmt->bindParam(':id_tipovehiculo', $this->id_tipovehiculo);
        $stmt->bindParam(':capacidad_motor', $this->capacidad_motor);
        $stmt->bindParam(':num_cilindros', $this->num_cilindros);
        $stmt->bindParam(':tipo_combustible', $this->tipo_combustible);
        $stmt->bindParam(':peso_bruto', $this->peso_bruto);
        $stmt->bindParam(':transmision', $this->transmision);
    
        return $stmt->execute();
    }
    

    public function buscar($criterio) {
        $query = "SELECT 
                      p.nombre_propietario, p.apellido_propietario, 
                      m.nombre_marca, mo.nombre_modelo, 
                      a.anio, a.placa, a.color, 
                      a.num_motor, a.num_chasis, 
                      t.tipo_vehiculo, 
                      a.capacidad_motor, a.num_cilindros, a.tipo_combustible, 
                      a.peso_bruto, a.transmision 
                  FROM automoviles a
                  JOIN propietarios p ON a.id_propietario = p.id_propietario
                  JOIN marcas m ON a.id_marca = m.id_marca
                  JOIN modelos mo ON a.id_modelo = mo.id_modelo
                  JOIN tipos_vehiculos t ON a.id_tipovehiculo = t.id_tipovehiculo
                  WHERE a.placa LIKE :criterio 
                  OR p.nombre_propietario LIKE :criterio 
                  OR m.nombre_marca LIKE :criterio 
                  OR mo.nombre_modelo LIKE :criterio";
    
        $stmt = $this->conn->prepare($query);
        $criterio = "%$criterio%";  // Añadimos comodines para la búsqueda parcial
        $stmt->bindParam(':criterio', $criterio);
        $stmt->execute();
    
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
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

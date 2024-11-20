<?php
class Propietario {
    private $conn; // Conexión a la base de datos
    private $table_name = "propietarios"; // Nombre de la tabla

    // Propiedades de la clase
    public $id_propietario;
    public $nombre_propietario;
    public $apellido_propietario;
    public $telefono_propietario;
    public $tipo_propietario;
    public $correo_propietario;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un nuevo propietario
    public function registrar() {

        if (empty($this->id_propietario)) {
            throw new Exception("El ID del propietario no puede estar vacío.");
        }
        // Query para insertar un nuevo propietario
        $query = "INSERT INTO " . $this->table_name . " (id_propietario, nombre_propietario, apellido_propietario, telefono_propietario, tipo_propietario, correo_propietario) VALUES (:id_propietario, :nombre_propietario, :apellido_propietario, :telefono_propietario, :tipo_propietario, :correo_propietario)";

        // Preparar la declaración
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos para evitar inyección SQL
        $this->id_propietario = htmlspecialchars(strip_tags($this->id_propietario));
        $this->nombre_propietario = htmlspecialchars(strip_tags($this->nombre_propietario));
        $this->apellido_propietario = htmlspecialchars(strip_tags($this->apellido_propietario));
        $this->telefono_propietario = htmlspecialchars(strip_tags($this->telefono_propietario));
        $this->tipo_propietario = htmlspecialchars(strip_tags($this->tipo_propietario));
        $this->correo_propietario = htmlspecialchars(strip_tags($this->correo_propietario));

        $stmt->bindParam(":id_propietario", $this->id_propietario);
        $stmt->bindParam(":nombre_propietario", $this->nombre_propietario);
        $stmt->bindParam(":apellido_propietario", $this->apellido_propietario);
        $stmt->bindParam(":telefono_propietario", $this->telefono_propietario);
        $stmt->bindParam(":tipo_propietario", $this->tipo_propietario);
        $stmt->bindParam(":correo_propietario", $this->correo_propietario);

        if ($stmt->execute()) {
            return true;
        }
    
        $errorInfo = $stmt->errorInfo();
        throw new Exception("Error al registrar el propietario: " . $errorInfo[2]);

    }
    }
    ?>
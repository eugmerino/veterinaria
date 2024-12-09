<?php
class Medico {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
     
    // Obtener todos los Medicos
    public function obtenerMedicos() {
        $sql = "SELECT * FROM medico";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Agregar un nuevo Medico
    public function agregarMedico($codigo, $nombre, $apellidos, $telefono) {
        $sql = "INSERT INTO Medico (codigo, nombre, apellidos, telefono)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $codigo,$nombre, $apellidos, $telefono);
        return $stmt->execute();
    }

    // Obtener un medico por su código
    public function obtenerMedicoPorCodigo($codigo) {
        $sql = "SELECT * FROM Medico WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar datos de un medico
    public function actualizarMedico($codigo, $nombre, $apellidos, $telefono) {
        $sql = "UPDATE Medico 
                SET nombre = ?, apellidos = ?, telefono = ?
                WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Error al preparar la consulta: " . $this->conn->error);
            return false;
        }
        $stmt->bind_param("ssss", $nombre, $apellidos, $telefono, $codigo);
        return $stmt->execute();
    }

    // Eliminar una consulta
    public function eliminarMedico($codigo) {
        $sql = "DELETE FROM medico WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $codigo);
        return $stmt->execute();
    }
}
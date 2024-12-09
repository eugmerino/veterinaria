<?php
class Paciente {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Obtener todos los pacientes
    public function obtenerPacientes() {
        $sql = "SELECT * FROM Paciente";
        $result = $this->conn->query($sql);
        if (!$result) {
            error_log("Error en la consulta: " . $this->conn->error);
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Agregar un nuevo paciente
    public function agregarPaciente($codigo, $nombrePropietario, $correo, $telefono, $nombrePaciente, $fechaNacimiento) {
        $sql = "INSERT INTO Paciente (codigo, nombre_propietario, correo, telefono, nombre_paciente, fecha_nacimiento)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Error al preparar la consulta: " . $this->conn->error);
            return false;
        }
        $stmt->bind_param("ssssss", $codigo, $nombrePropietario, $correo, $telefono, $nombrePaciente, $fechaNacimiento);
        return $stmt->execute();
    }

    // Obtener un paciente por su código
    public function obtenerPacientePorCodigo($codigo) {
        $sql = "SELECT * FROM Paciente WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Error al preparar la consulta: " . $this->conn->error);
            return null;
        }
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar datos de un paciente
    public function actualizarPaciente($codigo, $nombrePropietario, $correo, $telefono, $nombrePaciente, $fechaNacimiento) {
        $sql = "UPDATE Paciente 
                SET nombre_propietario = ?, correo = ?, telefono = ?, nombre_paciente = ?, fecha_nacimiento = ?
                WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Error al preparar la consulta: " . $this->conn->error);
            return false;
        }
        $stmt->bind_param("ssssss", $nombrePropietario, $correo, $telefono, $nombrePaciente, $fechaNacimiento, $codigo);
        return $stmt->execute();
    }

    // Eliminar un paciente
    public function eliminarPaciente($codigo) {
        $sql = "DELETE FROM Paciente WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Error al preparar la consulta: " . $this->conn->error);
            return false;
        }
        $stmt->bind_param("s", $codigo);
        return $stmt->execute();
    }
}
?>

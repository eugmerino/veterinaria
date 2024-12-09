<?php
class Expediente {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Obtener todos los expedientes
    public function obtenerExpedientes() {
        $sql = "SELECT * FROM Expediente";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener todos los expedientes de un paciente
    public function obtenerExpedientesPorPaciente($codigoPaciente) {
        $sql = "
            SELECT e.numero_expediente, e.diagnostico, e.tratamiento
            FROM expediente e
            INNER JOIN consulta c ON e.numero_expediente = c.expediente
            INNER JOIN paciente p ON c.paciente = p.codigo
            WHERE p.codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $codigoPaciente);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    // Agregar un nuevo expediente
    public function agregarExpediente($numeroExpediente, $diagnostico, $tratamiento) {
        $sql = "INSERT INTO Expediente (numero_expediente, diagnostico, tratamiento)
                VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iss", $numeroExpediente, $diagnostico, $tratamiento);
        return $stmt->execute();
    }

    // Obtener un expediente por número
    public function obtenerExpedientePorNumero($numeroExpediente) {
        $sql = "SELECT * FROM Expediente WHERE numero_expediente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $numeroExpediente);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar un expediente
    public function actualizarExpediente($numeroExpediente, $diagnostico, $tratamiento) {
        $sql = "UPDATE Expediente 
                SET diagnostico = ?, tratamiento = ?
                WHERE numero_expediente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $diagnostico, $tratamiento, $numeroExpediente);
        return $stmt->execute();
    }

    // Eliminar un expediente
    public function eliminarExpediente($numeroExpediente) {
        $sql = "DELETE FROM Expediente WHERE numero_expediente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $numeroExpediente);
        return $stmt->execute();
    }
}
?>

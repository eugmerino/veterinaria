<?php
require_once __DIR__ . '/../../../config/conexion.php';


class Consulta {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Obtener todas las consultas
    public function obtenerConsultas() {
        $sql = "SELECT * FROM Consulta";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Agregar una nueva consulta
    public function agregarConsulta($codigo, $fecha, $hora, $paciente, $medico, $expediente) {
        $sql = "INSERT INTO Consulta (codigo, fecha, hora, paciente, medico, expediente)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $codigo, $fecha, $hora, $paciente, $medico, $expediente);
        return $stmt->execute();
    }

    // Obtener una consulta por su código
    public function obtenerConsultaPorCodigo($codigo) {
        $sql = "SELECT * FROM Consulta WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar una consulta
    public function actualizarConsulta($codigo, $fecha, $hora, $paciente, $medico, $expediente) {
        $sql = "UPDATE Consulta 
                SET fecha = ?, hora = ?, paciente = ?, medico = ?, expediente = ?
                WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssis", $fecha, $hora, $paciente, $medico, $expediente, $codigo);
        return $stmt->execute();
    }

    // Eliminar una consulta
    public function eliminarConsulta($codigo) {
        $sql = "DELETE FROM Consulta WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $codigo);
        return $stmt->execute();
    }
}
?>

<?php
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

    // Obtener todas las consultas, incluyendo información del paciente y medico 
    public function obtenerConsultasPacientesMedicos() {
        $sql = "
            SELECT 
                consulta.codigo AS codigo_consulta,
                consulta.fecha AS fecha_consulta,
                consulta.hora AS hora_consulta,
                paciente.codigo AS codigo_paciente,
                paciente.nombre_paciente AS nombre_paciente,
                paciente.nombre_propietario AS nombre_propietario,
                paciente.correo AS correo_paciente,
                paciente.telefono AS telefono_paciente,
                medico.codigo AS codigo_medico,
                CONCAT(medico.nombre, ' ', medico.apellidos) AS nombre_completo_medico,
                medico.telefono AS telefono_medico
            FROM 
                consulta
            JOIN 
                paciente ON consulta.paciente = paciente.codigo
            JOIN 
                medico ON consulta.medico = medico.codigo
            ORDER BY 
                consulta.fecha ASC;

            ";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener todas las consultas de un paciente, incluyendo información del expediente
    public function obtenerConsultasPorPaciente($codigoPaciente) {
        $sql = "
            SELECT 
                c.codigo AS consulta_codigo, 
                c.fecha, 
                c.hora, 
                c.medico, 
                c.expediente AS expediente_id,
                e.diagnostico,
                e.numero_expediente
            FROM consulta c
            INNER JOIN paciente p ON c.paciente = p.codigo
            LEFT JOIN expediente e ON c.expediente = e.numero_expediente
            WHERE p.codigo = ?
            ORDER BY c.fecha ASC";
            
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $codigoPaciente);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
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
    public function actualizarConsulta($codigo, $fecha, $hora, $medico) {
        $sql = "UPDATE Consulta 
                SET fecha = ?, hora = ?, medico = ?
                WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $fecha, $hora, $medico, $codigo);
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

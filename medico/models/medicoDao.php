<?php
class Medico {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
     
    // Obtener todos los Medicos
    public function obtenerMedico() {
        $sql = "SELECT * FROM medico";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Agregar un nuevo Medico
    public function agregarMedico($codigo, $nombre, $apellido, $telefono) {
        $sql = "INSERT INTO Consulta (codigo, nombre, apellido, telefono)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $codigo,$nombre, $apellido, $telefono);
        return $stmt->execute();
    }

    // Obtener un medico por su código
    public function obtenerMedicoPorCodigo($codigo) {
        $sql = "SELECT * FROM medico WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar una consulta
    public function actualizarMedico( $nombre, $apellido, $telefono ) {
        $sql = "UPDATE medico 
                SET  nombre = ?, apellido = ?, telefono = ?
                WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssis",  $nombre, $apellido, $telefono);
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
<?php
require_once __DIR__ . '/../../../config/conexion.php';


class Usuario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Obtener todas las consultas
    public function obtenerUsuarios() {
        $sql = "SELECT * FROM Usuario";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Agregar una nueva consulta
    public function addUsuario($codigo, $nombre, $contrasenia) {
        $sql = "INSERT INTO Usuario (codigo, nombre, contrasenia)
                VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $codigo, $nombre, $contrasenia);
        return $stmt->execute();
    }

    // Obtener un Usuario por su código
    public function obtenerUsuarioPorCodigo($codigo) {
        $sql = "SELECT * FROM Usuario WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar un Usuario
    public function actualizarUsuario($codigo, $nombre, $contrasenia) {
        $sql = "UPDATE Usuario 
                SET nombre = ?, contrasenia = ?
                WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $contrasenia, $codigo);
        return $stmt->execute();
    }

    // Eliminar un Usuario
    public function eliminarUsuario($codigo) {
        $sql = "DELETE FROM Usuario WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $codigo);
        return $stmt->execute();
    }
}
?>

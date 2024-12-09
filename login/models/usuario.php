<?php
require_once __DIR__ . '/../../config/conexion.php';


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
        try{
            $sql = "INSERT INTO Usuario (codigo, nombre, contrasenia)
                VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $codigo, $nombre, $contrasenia);
            $stmt->execute(); 
            return $stmt; 
        }catch (Exception $e) {
            // Verificar si el error es por restricción UNIQUE
            return null;
        }
                  
    }

    // Obtener un Usuario por su código
    public function obtenerUsuarioPorCodigo($codigo) {
        $sql = "SELECT * FROM Usuario WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Obtener un Usuario por su código
    public function obtenerUsuarioPorUser($username) {
            $sql = "SELECT * FROM Usuario WHERE nombre = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();    
    }

    // Validar usuario
    public function obtenerUsuarioPorCodigoYContra($codigo,$contrasenia) {
        $sql = "SELECT * FROM Usuario WHERE  codigo = ? AND contrasenia = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $codigo, $contrasenia);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar un Usuario
    public function actualizarUsuario($codigo, $nombre, $contrasenia) {
        try{
            $sql = "UPDATE Usuario 
                    SET nombre = ?, contrasenia = ?
                    WHERE codigo = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $nombre, $contrasenia, $codigo);
            return $stmt->execute();
        }catch (Exception $e) {
            return null;
        }
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

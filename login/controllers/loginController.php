<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../models/usuario.php';
class LoginController {
    private $usuarioModel;

    public function __construct($conn) {
        $this ->usuarioModel= new Usuario($conn);
    }
    public function index() {
        $title = "Inicio";
        require_once __DIR__ . '/../views/login.php';
    }

    public function validarUsuario(){
        header('Content-Type: application/json');  // Define el encabezado JSON una vez al principio

        // Obtener los datos recibidos
        $input = file_get_contents('php://input');
        $usuario = json_decode($input, true);

        // Verificar si los datos requeridos fueron recibidos
        if (isset($usuario['username']) && isset($usuario['password'])) {
            $nombre = $usuario["username"];
            $contrasenia = $usuario["password"];

            // Suponiendo que tienes un modelo para obtener al usuario desde la base de datos
            $usuario = $this->usuarioModel->obtenerUsuarioPorCodigoYContra($nombre, $contrasenia);
            
            if ($usuario) {
                // Usuario encontrado
                $json = json_encode([
                    'status' => 'sucess',
                    'user' => $nombre,
                    'codigo'=>$nombre,
                ]);
            } else {
                // Usuario no encontrado
                $json = json_encode([
                    'status' => 'failed',
                    'message' => 'Usuario no encontrado',
                    'user' => null,
                    'pass' => null
                ]);
            }
        } else {
            // Datos no recibidos correctamente
            $json = json_encode([
                'status' => 'failed',
                'message' => 'Datos incorrectos o incompletos',
                'user' => null,
                'pass' => null
            ]);
        }
        // Enviar la respuesta JSON
        echo $json;
        exit();  // Finalizamos la ejecución después de enviar la respuesta JSON

    }
}
?>
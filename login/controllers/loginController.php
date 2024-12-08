<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../models/usuario.php';
require_once __DIR__ . '/../validacion.php';
class LoginController {
    private $usuarioModel;
    //private $clave="ññññ41jffjjf";//esto debe de ir en una .env

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
        $clave="ññññ41jffjjf";//esto debe de ir en una .env
        // Verificar si los datos requeridos fueron recibidos
        if (isset($usuario['username']) && isset($usuario['password'])) {
            $nombre = $usuario["username"];
            $contrasenia = $usuario["password"];

            //Suponiendo que tienes un modelo para obtener al usuario desde la base de datos
            $usuario = $this->usuarioModel->obtenerUsuarioPorCodigoYContra($nombre, $contrasenia);
            $payload = [
                "usuario" => $nombre,
                "codigo" => $nombre,//aqui debe de ir el codigo en teoria xd
                "iat" => time(), // Fecha de emisión
                "exp" => time() + 3600 // Expira en 1 hora
            ];
            
            if ($usuario) {
                // Usuario encontrado
                $jwt = crearToken($payload, $clave);//aqui debe de ir codigo y nombre que es el username                
                $json = json_encode([
                    'status' => 'sucess',
                    'message' => 'Usuario no encontrado',
                    'jwt' => $jwt
                ]);
            } else {
                // Usuario no encontrado
                $json = json_encode([
                    'status' => 'failed',
                    'message' => 'Usuario no encontrado',
                    'jwt' => null
                ]);
            }
        } else {
            // Datos no recibidos correctamente
            $json = json_encode([
                'status' => 'failed',
                'message' => 'Datos incorrectos o incompletos',
                'jwt' => null
            ]);
        }
        // Enviar la respuesta JSON
        echo $json;
        exit();  // Finalizamos la ejecución después de enviar la respuesta JSON

    }

    function validarToken(){
        header('Content-Type: application/json');  // Define el encabezado JSON una vez al principio

        // Capturar el token desde los parámetros de consulta
        $input = file_get_contents('php://input');
        $jwt = json_decode($input, true);

        // Obtener los datos recibidos
        $clave="ññññ41jffjjf";//esto debe de ir en una .env
        if (isset($jwt['jwt'])){
            $resultado=verificarToken($jwt['jwt'],$clave);
            if($resultado){
                $json = json_encode([
                    'status' => 'sucess'
                ]);
            }else{
                $json = json_encode([
                    'status' => 'failed'
                ]);
            }
        }else{
            $json = json_encode([
                'status' => 'failed'
            ]);
        }
        echo $json;
    }
}
?>
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

    public function validarUsuario($nombre,$contrasenia){
        $usuario = $this->usuarioModel->obtenerUsuarioPorCodigoYContra($nombre,$contrasenia);
        if($usuario){
            //echo json_encode(['status'=>'sucess', 'data' => $usuario]);
            header("Location: /veterinaria/inicio");
            exit();
        }else{
            echo json_encode(['status' => 'failed', 'data' => 'not_found']);
        }
    }
}
?>
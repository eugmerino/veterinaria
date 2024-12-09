<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../models/usuario.php';
require_once __DIR__ . '/../utils/encript.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct($conn) {
        $this ->usuarioModel= new Usuario($conn);
    }
    public function usuarios() {
        $title = "Usuarios";
        $datos=$this->mostrarDatos();
        require __DIR__ . '/../views/crudLogin.php';
    }

    public function mostrarDatos(){
        $datos=$this->usuarioModel->obtenerUsuarios();
        return $datos;

    }

    public function registrar(){
        $username=$_POST['username'];
        $codigo =$_POST['codigo'];
        $contrasenia=$_POST['password'];
        $encript = new Crypto("miClaveSuperSeguraDe32Caracteres");//lo mismo debe de ir en env.  
        $contrasenia = $encript -> encrypt($contrasenia);
        $resultado=$this->usuarioModel->addUsuario($codigo,$username,$contrasenia);

        if($resultado){
            echo json_encode(['status'=>'succes']);
        }else{
            echo json_encode(['status'=>'failed']);
        }

    }

    public function obtener(){
        header('Content-Type: application/json');  // Define el encabezado JSON una vez al principio

        // Obtener los datos recibidos
        $input = file_get_contents('php://input');
        $opcion = json_decode($input, true);
        if (isset($opcion['opcion'])){
            $codigo = $opcion['codigo'];
            $encript = new Crypto("miClaveSuperSeguraDe32Caracteres");//lo mismo debe de ir en env.  
            $resultado=$this->usuarioModel->obtenerUsuarioPorCodigo($codigo);
            if($opcion['opcion']=='obtener' && $resultado){
                $contrasenia = $encript -> decrypt($resultado['contrasenia']);
                echo json_encode(['status'=>'succes', 'codigo'=>$resultado['codigo'],
                'nombre'=>$resultado['nombre'], 'contrasenia'=>$contrasenia]);
        }else{
            echo json_encode(['status'=>'failed']);
        }
        }
    }

    public function editar(){
        $username=$_POST['username'];
        $codigo =$_POST['codigo'];
        $contrasenia=$_POST['password'];
        $encript = new Crypto("miClaveSuperSeguraDe32Caracteres");//lo mismo debe de ir en env.  
        $contrasenia = $encript -> encrypt($contrasenia);
        $resultado=$this->usuarioModel->actualizarUsuario($codigo,$username,$contrasenia);

        if($resultado){
            echo json_encode(['status'=>'succes']);
        }else{
            echo json_encode(['status'=>'failed']);
        }

    }

    public function eliminar(){
        header('Content-Type: application/json');  // Define el encabezado JSON una vez al principio

        // Obtener los datos recibidos
        $input = file_get_contents('php://input');
        $opcion = json_decode($input, true);

        if (isset($opcion['opcion'])){
            $codigo = $opcion['codigo'];
            $resultado=$this->usuarioModel->eliminarUsuario($codigo);
            if($opcion['opcion']=='eliminar' && $resultado){
                echo json_encode([
                    'status' => 'sucess'
                ]);
            }else{
                echo json_encode([
                    'status' => 'failed'
                ]);
            }
        }else{
            echo json_encode([
                'status' => 'failed'
            ]);
        }
    }
}
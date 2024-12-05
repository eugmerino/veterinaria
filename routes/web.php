<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../home/controllers/homeController.php';
require_once __DIR__ . '/../consulta/controllers/consultaController.php';
require_once __DIR__ . '/../login/controllers/loginController.php';
try {
    $conn = getConnection(); // Obtén la conexión
    //echo "Conexión exitosa"; // Debugging
} catch (Exception $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
    exit();
}

// Instanciar controladores
$homeController = new HomeController();
$consultaController = new ConsultaController($conn);
$loginController = new LoginController($conn);

// Obtener la ruta solicitada
$requestUri = str_replace('/veterinaria', '', $_SERVER['REQUEST_URI']);
echo("$requestUri");
// Rutas
if ($requestUri === '/' || $requestUri === '') {
    // Ruta principal (Login)
     $loginController->index();
    //$homeController->index();
} elseif($requestUri === '/login/validar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    //Validar Usuario
    $loginController->validarUsuario($_POST['username'], $_POST['password']);
} elseif ($requestUri === '/consulta/validarPaciente' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar paciente (AJAX)
    $consultaController->validarPaciente($_POST['codigo']);
} elseif ($requestUri === '/consulta/agregarPaciente' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Agregar paciente (AJAX)
    $consultaController->agregarPaciente($_POST);
} elseif ($requestUri === '/consultas') {
    // Vista de consulta de pacientes
    require_once __DIR__ . '/../consulta/views/consulta.php';
}elseif ($requestUri === '/inicio') {
    // Vista de consulta de pacientes
    require_once __DIR__ . '/../home/views/home.php';
} else {
    // Ruta no encontrada
    echo "404 - Página no encontrada.";
}

<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../home/controllers/homeController.php';
require_once __DIR__ . '/../consulta/controllers/pacienteController.php';
require_once __DIR__ . '/../login/controllers/loginController.php';
require_once __DIR__ . '/../consulta/controllers/consultaController.php';
require_once __DIR__ . '/../consulta/controllers/expedienteController.php';

// Instanciar controladores
$homeController = new HomeController();
$pacienteController = new PacienteController($conn);
$loginController = new LoginController($conn);
$consultaController = new ConsultaController($conn);
$expedienteController = new ExpedienteController($conn);

// Obtener la ruta solicitada
$requestUri = filter_var(
    str_replace('/veterinaria', '', $_SERVER['REQUEST_URI']),
    FILTER_SANITIZE_URL
);

// Definir las rutas
$routes = [
    '/' => fn() => $loginController->index(),
    '/login/validar' => fn() => $loginController->validarUsuario($_POST['username'], $_POST['password']),
    '/inicio' => fn() => $homeController->home(),
    '/consultas' => fn() => $consultaController->consultasView(),
    '/registrar-consulta' => fn() => $consultaController->consultaView(),
    '/buscar-paciente' => fn() => $pacienteController->buscarPaciente(),
    '/registrar-paciente' => fn() => $pacienteController->registrarPaciente(),
    '/buscar-consultas' => fn() => $consultaController->consultasPorPaciente(),
    '/buscar-expediente' => fn() => $expedienteController->buscarExpediente(),
    '/registrar-expediente' => fn() => $expedienteController->registrarExpediente(),
    '/actualizar-expediente' => fn() => $expedienteController->actualizarExpediente(),
    '/eliminar-expediente' => fn() => $expedienteController->eliminarExpediente(),
    '/buscar-consulta' => fn() => $consultaController->buscarConsulta(),
    '/registrar-consulta-nueva' => fn() => $consultaController->registrarConsulta(),
    '/actualizar-consulta' => fn() => $consultaController->actualizarConsulta(),
    '/eliminar-consulta' => fn() => $consultaController->eliminarConsulta(),
]; 

// Ejecutar la ruta correspondiente
if (array_key_exists($requestUri, $routes)) {
    $routes[$requestUri]();
} else {
    echo "404 - Página no encontrada.";
}

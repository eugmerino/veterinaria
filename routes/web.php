<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../home/controllers/homeController.php';
require_once __DIR__ . '/../consulta/controllers/pacienteController.php';
require_once __DIR__ . '/../login/controllers/loginController.php';
require_once __DIR__ . '/../login/controllers/usuarioController.php';

// Instanciar controladores
$homeController = new HomeController();
$pacienteController = new PacienteController($conn);
$loginController = new LoginController($conn);
$usuarioController = new UsuarioController($conn);

// Obtener la ruta solicitada
$requestUri = filter_var(
    str_replace('/veterinaria', '', $_SERVER['REQUEST_URI']),
    FILTER_SANITIZE_URL
);

// Definir las rutas
$routes = [
    '/' => fn() => $loginController->index(),
    '/login/validar' => fn() => $loginController->validarUsuario(),
    '/validarToken' => fn() => $loginController->validarToken(),
    '/inicio' => fn() => $homeController->home(),
    '/consultas' => fn() => $pacienteController->listarPacientes(),
    '/buscar-paciente' => fn() => $pacienteController->buscarPaciente(),
    '/registrar-paciente' => fn() => $pacienteController->registrarPaciente(),
    '/usuarios' => fn() => $usuarioController->usuarios(),
    '/usuario/registrar' => fn() => $usuarioController->registrar(),
    '/usuario/eliminar' => fn() => $usuarioController->eliminar(),
    '/usuario/obtener' => fn() => $usuarioController->obtener(),
    '/usuario/editar' => fn() => $usuarioController->editar()
]; 

// Ejecutar la ruta correspondiente
if (array_key_exists($requestUri, $routes)) {
    $routes[$requestUri]();
} else {
    echo "404 - Página no encontrada.";
}

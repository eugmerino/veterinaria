<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../home/controllers/homeController.php';
require_once __DIR__ . '/../consulta/controllers/pacienteController.php';
require_once __DIR__ . '/../login/controllers/loginController.php';
require_once __DIR__ . '/../consulta/controllers/consultaController.php';
require_once __DIR__ . '/../consulta/controllers/expedienteController.php';
require_once __DIR__ . '/../medico/controllers/medicoController.php';
require_once __DIR__ . '/../login/controllers/usuarioController.php';

// Instanciar controladores
$homeController = new HomeController();
$pacienteController = new PacienteController($conn);
$loginController = new LoginController($conn);
$consultaController = new ConsultaController($conn);
$expedienteController = new ExpedienteController($conn);
$medicoController = new MedicoController($conn);
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
    '/pacientes' => fn() => $pacienteController->pacientesView(),
    '/actualizar-paciente' => fn() => $pacienteController->actualizarPaciente(),
    '/eliminar-paciente' => fn() => $pacienteController->eliminarPaciente(),
    '/medicos' => fn() => $medicoController->listarMedicos(),
    '/registrar-medico' => fn() => $medicoController->registrarMedico(),
    '/buscar-medico' => fn() => $medicoController->buscarMedico(),
    '/actualizar-medico' => fn() => $medicoController->actualizarMedico(),
    '/eliminar-medico' => fn() => $medicoController->eliminarMedico(),
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

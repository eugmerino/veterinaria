<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../home/controllers/homeController.php';
require_once __DIR__ . '/../consulta/controllers/consultaController.php';

$conn = require_once __DIR__ . '/../config/conexion.php';

// Instanciar controladores
$homeController = new HomeController();
$consultaController = new ConsultaController($conn);

// Obtener la ruta solicitada
$requestUri = str_replace('/veterinaria', '', $_SERVER['REQUEST_URI']);
echo("$requestUri");
// Rutas
if ($requestUri === '/' || $requestUri === '') {
    // Ruta principal (Home)
    $homeController->index();
} elseif ($requestUri === '/consulta/validarPaciente' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar paciente (AJAX)
    $consultaController->validarPaciente($_POST['codigo']);
} elseif ($requestUri === '/consulta/agregarPaciente' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Agregar paciente (AJAX)
    $consultaController->agregarPaciente($_POST);
} elseif ($requestUri === '/consultas') {
    // Vista de consulta de pacientes
    require_once __DIR__ . '/../consulta/views/consulta.php';
} else {
    // Ruta no encontrada
    echo "404 - Página no encontrada.";
}

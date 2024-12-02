<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../home/controllers/HomeController.php';

// Instanciar el controlador
$homeController = new HomeController();

// Ruta principal (Home)
if ($_SERVER['REQUEST_URI'] === '/') {
    $homeController->index();
} else {
    echo "404 - Página no encontrada";
}
/* 
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../home/controllers/HomeController.php';

// Instanciar el controlador
$homeController = new HomeController();

// Ruta principal (Home)
if ($_SERVER['REQUEST_URI'] === '/') {
    $homeController->index();
} elseif ($_SERVER['REQUEST_URI'] === '/pacientes') {
    require_once __DIR__ . '/../consulta/controllers/PacienteController.php';
    $controller = new PacienteController($conn);
    $controller->listar();
} else {
    echo "404 - Página no encontrada";
}
*/
?>




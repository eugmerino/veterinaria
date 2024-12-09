<?php
    define('BASE_URL', '/veterinaria');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Veterinaria'; ?></title>
    <link rel="stylesheet" href="/veterinaria/public/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul class="nav-menu">
                <li><a href="<?php echo BASE_URL; ?>/inicio">Inicio</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/pacientes">Pacientes</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/consultas">Consultas</a></li>
                    <li><a href="/expedientes">Expedientes</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/medicos">Medicos</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/usuarios">Usuarios</a></li>
            </ul>
            <ul class="nav-right">
                    <li><a href="#">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>

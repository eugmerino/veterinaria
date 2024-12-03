<?php
    define('BASE_URL', '/veterinaria');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Home'; ?></title>
    <link rel="stylesheet" href="/veterinaria/public/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="<?php echo BASE_URL; ?>/consulta/paciente">Pacientes</a></li>
                <li><a href="<?php echo BASE_URL; ?>/consultas">Consultas</a></li>
                <li><a href="/expedientes">Expedientes</a></li>
                <li><a href="/medicos">Medicos</a></li>
            </ul>
        </nav>
    </header>
    <main>

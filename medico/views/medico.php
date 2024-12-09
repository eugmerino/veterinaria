<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Médicos</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJx3y6XwA4pU5P6f9b8p9yU25x4jDmrDIC8Ff9jV2l4nYFJr9TZCQm56u4Wb" crossorigin="anonymous">
</head>
<body>

    <div class="container my-5">
        <!-- Header Section -->
        <header class="text-center mb-5">
            <h1>Gestión de Médicos</h1>
        </header>

        <div class="row">
        
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4>Agregar Nuevo Médico</h4>
                    </div>
                    <div class="Modal">
                        <form action="procesar.php" method="POST">
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Código</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" required>
                            </div>

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                            </div>

                            <button type="submit" class="btn btn-success" name="action" value="add">Agregar Médico</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List of doctors -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4>Lista de Médicos</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- PHP to dynamically generate doctor list -->
                                <?php
                                
                                foreach ($medicos as $m) {
                                    echo "<tr>
                                            <td>{$m['codigo']}</td>
                                            <td>{$m['nombre']}</td>
                                            <td>{$m['apellidos']}</td>
                                            <td>{$m['telefono']}</td>
                                            <td>
                                                <a href='editar.php?codigo={$m['codigo']}' class='btn btn-warning btn-sm'>Editar</a>
                                                <a href='eliminar.php?codigo={$m['codigo']}' class='btn btn-danger btn-sm'>Eliminar</a>
                                            </td>
                                          </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="text-center mt-5 py-3 bg-dark text-white">
        <p>&copy; 2024 Gestión de Médicos</p>
    </footer>

    <!-- Include Bootstrap JS and dependencies from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb6E7m71Rk0z6A2g7L3z5xxd14P8sAq/cX3MQj9WyB7s1tP4lR" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0Hh0pG3Pa6p6d3Vw7+1fip7ruXzoIa+f2n8k8k1ABwnX8+S3" crossorigin="anonymous"></script>
</body>
</html>

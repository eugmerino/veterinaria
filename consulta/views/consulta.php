<?php
require_once __DIR__ . '/../../home/views/partials/header.php';
?>

    <div class="container mt-5">
        <h2 class="mb-4">Validar Paciente</h2>
        <form id="validarPacienteForm" class="mb-3">
            <div class="mb-3">
                <label for="codigo" class="form-label">Código del Paciente:</label>
                <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese el código" required>
            </div>
            <button type="submit" class="btn btn-primary">Validar</button>
        </form>

        <!-- Información del paciente -->
        <div id="pacienteInfo" class="d-none">
            <h4>Información del Paciente</h4>
            <ul id="infoList" class="list-group"></ul>
        </div>

        <!-- Modal para agregar paciente -->
        <div class="modal fade" id="nuevoPacienteModal" tabindex="-1" aria-labelledby="nuevoPacienteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nuevoPacienteModalLabel">Agregar Nuevo Paciente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="agregarPacienteForm">
                            <div class="mb-3">
                                <label for="nombrePropietario" class="form-label">Nombre del Propietario:</label>
                                <input type="text" id="nombrePropietario" name="nombrePropietario" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo:</label>
                                <input type="email" id="correo" name="correo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="text" id="telefono" name="telefono" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="nombrePaciente" class="form-label">Nombre del Paciente:</label>
                                <input type="text" id="nombrePaciente" name="nombrePaciente" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
                                <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="veterinaria/public/js/script.js"></script>

<?php require_once __DIR__ . '/../../home/views/partials/footer.php'; ?>

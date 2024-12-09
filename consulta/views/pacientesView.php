<?php 
    require_once __DIR__ . '/../../home/views/partials/header.php';
?>

<div class="container">
    <h1 class="m-2 text-center">Pacientes</h1>
    <!-- Formulario para buscar consulta -->
    <form id="buscarConsultasForm" class="mb-2">
        <div class="row align-items-end">
            <div class="col-md-6 mb-2">
                <label for="codigoConsultaBuscar" class="form-label">Ingrese el código del paciente: (para ver detalles, modificar o eliminar)</label>
                <input type="text" id="codigoPacienteBuscar" name="codigo" class="form-control" placeholder="Código del paciente" required>
            </div>
            <div class="col-md-3 text-center mb-2">
                <button type="button" id="buscarPacienteBtn" class="btn btn-primary w-100">Buscar</button>
            </div>
            <div class="col-md-3 text-center mb-2">
                <button type="button" id="abrirRegistroModalBtn" class="btn btn-success w-100">Registrar Nuevo Paciente</button>
            </div>
        </div>
    </form>
    <div>
        <h3 class="mb-3">Registros:</h3>
        <div class="table-container" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Fecha de nacimiento</th>
                        <th>Dueño</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody id="dataConsultas">
                    <?php
                    if (!empty($pacientesList)) {
                        foreach ($pacientesList as $paciente) {
                            echo '<tr>';
                            echo '<td>' . $paciente['codigo'] . '</td>';
                            echo '<td>' . $paciente['nombre_paciente'] . '</td>';
                            echo '<td>' . $paciente['fecha_nacimiento'] . '</td>';
                            echo '<td>' . $paciente['nombre_propietario'] . '</td>';
                            echo '<td>' . $paciente['correo'] . '</td>';
                            echo '<td>' . $paciente['telefono'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No se encontraron pacientes.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para registrar nuevo paciente -->
<div id="registroModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Nuevo Paciente</h5>
                <button type="button" class="btn-close" id="cerrarModalBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registroPacienteForm">
                    <div class="mb-3">
                        <label for="registroCodigo" class="form-label">Código:</label>
                        <input type="text" name="codigo" id="registroCodigo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="registroNombrePropietario" class="form-label">Nombre del Propietario:</label>
                        <input type="text" name="nombre_propietario" id="registroNombrePropietario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="registroCorreo" class="form-label">Correo:</label>
                        <input type="email" name="correo" id="registroCorreo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="registroTelefono" class="form-label">Teléfono:</label>
                        <input type="text" name="telefono" id="registroTelefono" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="registroNombrePaciente" class="form-label">Nombre del Paciente:</label>
                        <input type="text" name="nombre_paciente" id="registroNombrePaciente" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="registroFechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nacimiento" id="registroFechaNacimiento" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal para actualizar y eliminar paciente -->
<div id="updateDeletePacienteModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar Paciente</h5>
                <button type="button" class="btn-close" id="cerrarModalUDBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateDeletePacienteForm">
                    <div class="mb-3">
                        <label for="codigoP" class="form-label">Código:</label>
                        <input type="text" name="codigoP" id="codigoP" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nombrePropiertarioP" class="form-label">Nombre del Propietario:</label>
                        <input type="text" name="nombrePropiertarioP" id="nombrePropiertarioP" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="correoP" class="form-label">Correo:</label>
                        <input type="email" name="correoP" id="correoP" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefonoP" class="form-label">Teléfono:</label>
                        <input type="text" name="telefonoP" id="telefonoP" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombreP" class="form-label">Nombre del Paciente:</label>
                        <input type="text" name="nombreP" id="nombreP" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fechaNacP" class="form-label">Fecha de Nacimiento:</label>
                        <input type="date" name="fechaNacP" id="fechaNacP" class="form-control" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 text-center mb-2"></div>
                        <div class="col-md-4 text-center mb-2">
                            <button type="submit" id="updateBtn" class="btn btn-primary w-100">Actualizar</button>
                        </div>
                        <div class="col-md-4 text-center mb-2">
                            <button type="button" id="deleteBtn" class="btn btn-danger w-100">Eliminar</button>
                        </div>
                        <div class="col-md-2 text-center mb-2"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php require_once __DIR__ . '/../../home/views/partials/footer.php'; ?>

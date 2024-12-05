<?php require_once __DIR__ . '/../../home/views/partials/header.php'; ?>

<div class="container">
    
    <h1 class="m-2 text-center">Gestión de Pacientes</h1>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="consultaTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="paciente-tab" data-bs-toggle="tab" href="#paciente" role="tab" aria-controls="paciente" aria-selected="true">Paciente</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="consulta-tab" data-bs-toggle="tab" href="#consulta" role="tab" aria-controls="consulta" aria-selected="false">Consulta</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="expediente-tab" data-bs-toggle="tab" href="#expediente" role="tab" aria-controls="expediente" aria-selected="false">Expediente</a>
        </li>
    </ul>
    

    <!-- Tab content -->
    <div class="tab-content mt-3" id="consultaTabsContent">

        <!-- paciente -->
        <div class="tab-pane fade show active" id="paciente" role="tabpanel" aria-labelledby="paciente-tab">
            <h4>Paciente</h4>
            <!-- Formulario para buscar pacientes -->
            <form id="buscarPacienteForm" class="mb-5">
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label for="codigoPaciente" class="form-label">Ingrese el código del paciente:</label>
                        <input type="text" id="codigoPaciente" name="codigo" class="form-control" placeholder="Código del paciente" required>
                    </div>
                    <div class="col-md-3 text-center">
                        <button type="button" id="buscarPacienteBtn" class="btn btn-primary w-100">Validar</button>
                    </div>
                    <div class="col-md-3 text-center">
                        <button type="button" id="abrirRegistroModalBtn" class="btn btn-success w-100">Registrar Nuevo Paciente</button>
                    </div>
                </div>
            </form>
            
            <!-- Contenedor para mostrar la información del paciente -->
            <div id="pacienteInfo"></div>
        </div>

        <!-- consulta -->
        <div class="tab-pane fade" id="consulta" role="tabpanel" aria-labelledby="consulta-tab">
            <h4>Consulta</h4>
            
        </div>

        <!-- Código fuente -->
        <div class="tab-pane fade" id="expediente" role="tabpanel" aria-labelledby="expediente-tab">
            <h4>Expediente</h4>
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
</div>



<?php require_once __DIR__ . '/../../home/views/partials/footer.php'; ?>

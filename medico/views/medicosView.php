<?php 
    require_once __DIR__ . '/../../home/views/partials/header.php';
?>

<div class="container">
    <h1 class="m-2 text-center">Medicos</h1>
    <!-- Formulario para buscar consulta -->
    <form id="buscarConsultasForm" class="mb-2">
        <div class="row align-items-end">
            <div class="col-md-6 mb-2">
                <label for="codigoConsultaBuscar" class="form-label">Ingrese el código del medico: (para ver detalles, modificar o eliminar)</label>
                <input type="text" id="codigoMedicoBuscar" name="codigo" class="form-control" placeholder="Código del medico" required>
            </div>
            <div class="col-md-3 text-center mb-2">
                <button type="button" id="buscarMedicoBtn" class="btn btn-primary w-100">Buscar</button>
            </div>
            <div class="col-md-3 text-center mb-2">
                <button type="button" id="abrirRegistroModalBtn" class="btn btn-success w-100">Registrar Nuevo Medico</button>
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
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody id="dataConsultas">
                    <?php
                    if (!empty($medicosList)) {
                        foreach ($medicosList as $medico) {
                            echo '<tr>';
                            echo '<td>' . $medico['codigo'] . '</td>';
                            echo '<td>' . $medico['nombre'] . '</td>';
                            echo '<td>' . $medico['apellidos'] . '</td>';
                            echo '<td>' . $medico['telefono'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No se encontraron medicos.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para registrar nuevo medico -->
<div id="registroModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Nuevo Medico</h5>
                <button type="button" class="btn-close" id="cerrarModalBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registroMedicoForm">
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código:</label>
                        <input type="text" name="codigo" id="codigo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal para actualizar y eliminar paciente -->
<div id="updateDeleteMedicoModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar Medico</h5>
                <button type="button" class="btn-close" id="cerrarModalUDBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateDeleteMedicoForm">
                <div class="mb-3">
                        <label for="codigoM" class="form-label">Código:</label>
                        <input type="text" name="codigo" id="codigoM" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nombreM" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombreM" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidosM" class="form-label">Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidosM" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefonoM" class="form-label">Teléfono:</label>
                        <input type="text" name="telefono" id="telefonoM" class="form-control" required>
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

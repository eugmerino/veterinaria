<?php 
    require_once __DIR__ . '/../../home/views/partials/header.php';
?>

<div class="container">
    <h1 class="m-2 text-center">Consultas</h1>
    <!-- Formulario para buscar consulta -->
    <form id="buscarConsultasForm" class="mb-2">
        <div class="row align-items-end">
            <div class="col-md-6 mb-2">
                <label for="codigoConsultaBuscar" class="form-label">Ingrese el código de la consulta: (para ver detalles, modificar o eliminar)</label>
                <input type="text" id="codigoConsultaBuscar" name="codigo" class="form-control" placeholder="Código de la consulta" required>
            </div>
            <div class="col-md-3 text-center mb-2">
                <button type="button" id="buscarConsultaBtn" class="btn btn-primary w-100">Buscar</button>
            </div>
            <div class="col-md-3 text-center mb-2">
                <a href="<?php echo BASE_URL; ?>/registrar-consulta" id="registrarConsultaBtn" class="btn btn-success w-100">Registrar Nueva Consulta</a>
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
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Dueño</th>
                        <th>Medico</th>
                    </tr>
                </thead>
                <tbody id="dataConsultas">
                    <?php
                    if (!empty($consultasList)) {
                        foreach ($consultasList as $consulta) {
                            echo '<tr>';
                            echo '<td>' . $consulta['codigo_consulta'] . '</td>';
                            echo '<td>' . $consulta['fecha_consulta'] . '</td>';
                            echo '<td>' . $consulta['hora_consulta'] . '</td>';
                            echo '<td>' . $consulta['nombre_paciente'] . '</td>';
                            echo '<td>' . $consulta['nombre_propietario'] . '</td>';
                            echo '<td>' . $consulta['nombre_completo_medico'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No se encontraron consultas.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal para actualizar o eliminar consulta y expediente -->
<div id="updateDeleteModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar</h5>
                <button type="button" class="btn-close" id="cerrarUpdateDeleteModalBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateDeleteModalForm">
                    <div class="row mb-3">
                        <h4>Consulta</h4>
                        <div class="col-md-6">
                            <label for="codigoConsulta" class="form-label">Código:</label>
                            <input type="text" name="codigo" id="codigoConsulta" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                            <?php if (isset($medicosList) && !empty($medicosList)) : ?>
                                <label for="medicoSelect" class="form-label">Médico:</label>
                                <select id="medicoSelect" name="medico" class="form-control">
                                    <option value="" disabled selected>Seleccione un medico</option>
                                    <?php foreach ($medicosList as $medico) : ?>
                                        <option value="<?php echo htmlspecialchars($medico['codigo']); ?>">
                                            <?php echo htmlspecialchars($medico['nombre'] . ' ' . $medico['apellidos']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php else : ?>
                                <p>No hay médicos disponibles.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fechaConsulta" class="form-label">Fecha:</label>
                            <input type="date" name="fecha" id="fechaConsulta" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="horaConsulta" class="form-label">Hora:</label>
                            <input type="time" name="hora" id="horaConsulta" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <h4>Expediente</h4>
                        <input type="number" name="numero" id="numeroExp" class="form-control d-none" disabled>
                        <div class="col-md-6">
                            <label for="diagnosticoExp" class="form-label">Diagnóstico:</label>
                            <textarea name="diagnostico" id="diagnosticoExp" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="tratamientoExp" class="form-label">Tratamiento:</label>
                            <textarea name="tratamiento" id="tratamientoExp" class="form-control" rows="4" required></textarea>
                        </div>
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

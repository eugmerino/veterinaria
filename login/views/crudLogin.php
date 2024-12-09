<?php require_once __DIR__ . '/../../home/views/partials/header.php'; ?>
<div class="container">
    
    <h1 class="m-2 text-center">Lista de Usuarios</h1>

    <div class="d-none">
        <input type="text" id="op" value="ingresar">
    </div>

    <!-- Modal para registrar nuevo paciente -->
    <div id="modalUsuario" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Formulario Usuario</h5>
                    <button type="button" class="btn-close" id="cerrarModalBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registroUsuarioForm">
                        <div class="mb-3">
                            <label for="registroCodigo" class="form-label">Código:</label>
                            <input type="text" name="codigo" id="registroCodigo" value="<?php echo $codigo ?? '' ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de usuario:</label>
                            <input type="text" name="username" id="username" value="<?php echo $resultado['nombre']??'' ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" name="password" id="password" value="<?php echo $resultado['contrasenia']??'' ?>" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 text-center">
        <button type="button" id="abrirRegistroModalBtn" class="btn btn-success w-100">Registrar nuevo usuario</button>
    </div>

    <div class="container mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Usuario</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $dato) { ?>
                        <tr>
                            <th scope="row"><?php echo $dato['codigo'] ?></th>
                            <td><?php echo $dato['nombre'] ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <button class="btn btn-primary btn-sm me-2" onclick="handleAction('edit', '<?php echo $dato['codigo']?>')">
                                        <i class="bi bi-pencil"></i> Editar
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="handleAction('delete', '<?php echo $dato['codigo'] ?>')">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>


<?php require_once __DIR__ . '/../utils/footerUsuario.php';; ?>
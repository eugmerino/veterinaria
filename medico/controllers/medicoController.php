<?php
require_once __DIR__ . '/../models/medicoDao.php';

class MedicoController {
    private $medico;

    public function __construct($conn) {
        $this->medico = new Medico($conn);
    }

    public function listarMedicos() {
        $medicosList = $this->medico->obtenerMedicos();
        require_once __DIR__ . '/../views/medicosView.php';
    }

    // Registrar un medico
    public function registrarMedico() {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];

        $resultado = $this->medico->agregarMedico($codigo, $nombre, $apellidos, $telefono);
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Medico registrado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar al medico']);
        }
    }

    // Buscar un medico
    public function buscarMedico() {
        $data = json_decode(file_get_contents("php://input"), true);
        $codigo = $data['codigo'] ?? '';

        $paciente = $this->medico->obtenerMedicoPorCodigo($codigo);
        if ($paciente) {
            echo json_encode(['success' => true, 'medico' => $paciente]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Medico no encontrado']);
        }
    }

    // Actualizar un medico
    public function actualizarMedico() {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];

        $resultado = $this->medico->actualizarMedico($codigo, $nombre, $apellidos, $telefono );
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Medico actualizado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar medico']);
        }
    }

    // Eliminar un medico
    public function eliminarMedico() {
        $codigo = $_POST['codigo'];

        $resultado = $this->medico->eliminarMedico($codigo);
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Medico eliminado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar medico']);
        }
    }

}
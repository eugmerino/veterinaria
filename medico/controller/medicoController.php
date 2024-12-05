<?php
require_once __DIR__ . '/../models/medicoDao.php';

class MedicoController {
    private $medicoModel;

    public function __construct($conn) {
        $this->medicoModel = new Medico($conn);
    }

    public function mostrarMedico() {
        $medicos = $this->medicoModel->obtenerMedico();

        require_once __DIR__ . '/../views/medico.php';
    }
    // Buscar un paciente
    public function buscarPaciente() {
        $data = json_decode(file_get_contents("php://input"), true);
        $codigo = $data['codigo'] ?? '';

        $paciente = $this->medicoModel->obtenerMedicoPorCodigo($codigo);
        if ($paciente) {
            echo json_encode(['success' => true, 'medico' => $paciente]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Medico no encontrado']);
        }
    }

    // Registrar un paciente
    public function registrarPaciente() {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
      
        $resultado = $this->medicoModel->agregarMedico($codigo, $nombre, $apellido, $telefono);
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Paciente registrado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar al paciente']);
        }
    }

}

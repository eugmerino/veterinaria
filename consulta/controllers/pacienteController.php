<?php
require_once __DIR__ . '/../models/paciente.php';

class PacienteController {
    private $pacienteModel;

    public function __construct($conn) {
        $this->pacienteModel = new Paciente($conn);
    }

    public function listarPacientes() {
        $pacientes = $this->pacienteModel->obtenerPacientes();
        require_once __DIR__ . '/../views/consultaView.php';
    }
    // Buscar un paciente
    public function buscarPaciente() {
        $data = json_decode(file_get_contents("php://input"), true);
        $codigo = $data['codigo'] ?? '';

        $paciente = $this->pacienteModel->obtenerPacientePorCodigo($codigo);
        if ($paciente) {
            echo json_encode(['success' => true, 'paciente' => $paciente]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Paciente no encontrado']);
        }
    }

    // Registrar un paciente
    public function registrarPaciente() {
        $codigo = $_POST['codigo'];
        $nombrePropietario = $_POST['nombre_propietario'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $nombrePaciente = $_POST['nombre_paciente'];
        $fechaNacimiento = $_POST['fecha_nacimiento'];

        $resultado = $this->pacienteModel->agregarPaciente($codigo, $nombrePropietario, $correo, $telefono, $nombrePaciente, $fechaNacimiento);
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Paciente registrado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar al paciente']);
        }
    }

}

<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../models/paciente.php';

class ConsultaController {
    private $pacienteModel;

    public function __construct($conn) {
        $this->pacienteModel = new Paciente($conn);
    }

    public function validarPaciente($codigo) {
        $paciente = $this->pacienteModel->obtenerPacientePorCodigo($codigo);
        if ($paciente) {
            echo json_encode(['status' => 'success', 'data' => $paciente]);
        } else {
            echo json_encode(['status' => 'not_found']);
        }
    }

    public function agregarPaciente($data) {
        $resultado = $this->pacienteModel->agregarPaciente(
            $data['codigo'],
            $data['nombrePropietario'],
            $data['correo'],
            $data['telefono'],
            $data['nombrePaciente'],
            $data['fechaNacimiento']
        );
        echo json_encode(['status' => $resultado ? 'success' : 'error']);
    }
}

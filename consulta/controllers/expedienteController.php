<?php
require_once __DIR__ . '/../models/expediente.php';

class ExpedienteController {
    private $expediente;

    public function __construct($conn) {
        $this->expediente = new Expediente($conn);
    }

    public function expedientesPorPaciente() {
        $data = json_decode(file_get_contents("php://input"), true);
        $codigo = $data['codigo'] ?? '';

        $expList = $this->expediente->obtenerExpedientesPorPaciente($codigo);
        if ($expList) {
            echo json_encode(['success' => true, 'expList' => $expList]);
        } else {
            echo json_encode(['success' => false, 'message' => 'El Paciente aun no tiene expedientes']);
        }
    }

    public function buscarExpediente() {
        $data = json_decode(file_get_contents("php://input"), true);
        $numero = $data['numero'] ?? '';

        $expediente = $this->expediente->obtenerExpedientePorNumero($numero);
        if ($expediente) {
            echo json_encode(['success' => true, 'expediente' => $expediente]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Expediente no encontrado']);
        }
    }

    // Registrar un expediente
    public function registrarExpediente() {
        $numero = $_POST['numero'];
        $diagnostico = $_POST['diagnostico'];
        $tratamiento = $_POST['tratamiento'];

        $resultado = $this->expediente->agregarExpediente($numero, $diagnostico, $tratamiento);
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Expediente registrado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar expediente']);
        }
    }

    // Actualizar un expediente
    public function actualizarExpediente() {
        $numero = $_POST['numero'];
        $diagnostico = $_POST['diagnostico'];
        $tratamiento = $_POST['tratamiento'];

        $resultado = $this->expediente->actualizarExpediente($numero, $diagnostico, $tratamiento);
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Expediente actualizado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar expediente']);
        }
    }

    // Actualizar un expediente
    public function eliminarExpediente() {
        $numero = $_POST['numero'];

        $resultado = $this->expediente->eliminarExpediente($numero);
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Expediente eliminado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar expediente']);
        }
    }

}

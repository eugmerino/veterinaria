<?php
require_once __DIR__ . '/../models/consulta.php';
require_once __DIR__ . '/../../medico/models/medicoDao.php';

class ConsultaController {
    private $consulta;
    private $medico;

    public function __construct($conn) {
        $this->consulta = new Consulta($conn);
        $this->medico = new Medico($conn);
    }

    public function consultasView() {
        $medicosList = $this->medico->obtenerMedico();
        $consultasList = $this->consulta->obtenerConsultasPacientesMedicos();
        require_once __DIR__ . '/../views/consultasView.php';
    }

    public function consultaView() {
        $medicosList = $this->medico->obtenerMedico();
        require_once __DIR__ . '/../views/consultaView.php';
    }

    public function consultasPorPaciente() {
        $data = json_decode(file_get_contents("php://input"), true);
        $codigo = $data['codigo'] ?? '';

        $consultasList = $this->consulta->obtenerConsultasPorPaciente($codigo);
        if ($consultasList) {
            echo json_encode(['success' => true, 'consultasList' => $consultasList]);
        } else {
            echo json_encode(['success' => false, 'message' => 'El Paciente aun no tiene expedientes']);
        }
    }

    // Buscar una consulta
    public function buscarConsulta() {
        $data = json_decode(file_get_contents("php://input"), true);
        $codigo = $data['codigo'] ?? '';

        $consulta = $this->consulta->obtenerConsultaPorCodigo($codigo);
        if ($consulta) {
            echo json_encode(['success' => true, 'consulta' => $consulta]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Consulta no encontrado']);
        }
    }

    // Registrar consulta
    public function registrarConsulta() {
        $codigo = $_POST['codigo'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $paciente = $_POST['paciente'];
        $medico = $_POST['medico'];
        $expediente = $_POST['expediente'];

        $resultado = $this->consulta->agregarConsulta($codigo, $fecha, $hora, $paciente, $medico, $expediente);
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Consulta registrada exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar la consulta']);
        }
    }

    // Actualizar consulta
    public function actualizarConsulta() {
        $codigo = $_POST['codigo'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $medico = $_POST['medico'];

        $resultado = $this->consulta->actualizarConsulta($codigo, $fecha, $hora, $medico);
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Consulta actualizada exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la consulta']);
        }
    }

    // Eliminar consulta
    public function eliminarConsulta() {
        $codigo = $_POST['codigo'];

        $resultado = $this->consulta->eliminarConsulta($codigo);
        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Consulta eliminada exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar la consulta']);
        }
    }

}

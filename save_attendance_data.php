<?php
header('Content-Type: application/json');
include_once "functions.php";

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['date'], $data['alumnos'])) {
    echo json_encode(['success' => false, 'message' => 'Datos no proporcionados correctamente.']);
    exit;
}

try {
    $result = saveAsistenciaData($data['date'], $data['alumnos']);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Asistencia guardada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar la asistencia.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

exit;
?>

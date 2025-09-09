<?php
include 'alumnoModel.php'; 

header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);

function deliver_response($status, $status_message, $data)
{
    http_response_code($status); 
    $response = [
        'status' => $status,
        'message' => $status_message,
        'data' => $data
    ];
    echo json_encode($response);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $data['nombre'] ?? null;
    $apellido = $data['apellido'] ?? null;

    $alumno = new AlumnoModel();

deliver_response(200, "registro con exito", $alumno->insertAlumno($nombre, $apellido));

}

?>
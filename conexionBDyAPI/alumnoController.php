<?php
include 'alumnoModel.php'; 

header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);

class AlumnoController{
    

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


    function obtenerAlumnos(){
        $alumno = new AlumnoModel();
        $this->deliver_response(200, "Listado de alumnos", $alumno->getAlumnos());
    }


    function obtenerAlumnosId($id){
        $alumno = new AlumnoModel();
        $this->deliver_response(200, "Alumno por ID", $alumno->getAlumnosId( $id));
    }



    function registrarAlumnos($data){
        $alumno = new AlumnoModel();
        $nombre = $data['nombre'] ?? null;
        $apellido = $data['apellido'] ?? null;
        $this->deliver_response(200, "registro con exito", $alumno->insertAlumno($nombre, $apellido));
    }

    function actualizarAlumnos($data){
        $alumno = new AlumnoModel();
        $nombre = $data['nombre'] ?? null;
        $apellido = $data['apellido'] ?? null;
        $idalumnos = $data['idalumnos'] ?? null;
        $this->deliver_response(200, "registro con exito", $alumno->updateAlumno($idalumnos,$nombre, $apellido));
    }

   

}

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$controller = new AlumnoController();

// Eliminar parámetros de query
$request = explode('?', $request)[0];
$segments = explode('/', trim($request, '/'));

// Ejemplo: /alumnos/5 → ['alumnos', '5']

if ($method === 'GET') {
    if (isset($segments[1])) {
        $controller->obtenerAlumnosId($segments[1]);
    } else {
        $controller->obtenerAlumnos();
    }
} elseif ($method === 'POST') {
    $controller->registrarAlumnos($data);
} elseif ($method === 'PUT') {
    $data['idalumnos'] = $segments[1] ?? null;
    $controller->actualizarAlumnos($data);
}


?>
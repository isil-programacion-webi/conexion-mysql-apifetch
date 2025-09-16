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


$controller = new AlumnoController();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $controller->obtenerAlumnosId($_GET['id']);
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $controller->obtenerAlumnos();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->registrarAlumnos($data);
}elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $controller->actualizarAlumnos($data);
}



?>
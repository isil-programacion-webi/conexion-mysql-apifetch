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

    function obtenerAlumnoApellido($apellido){
        $alumno = new AlumnoModel();
        $this->deliver_response(200, "Alumno por ID", $alumno->getAlumnosLikeApellido( $apellido));
    }
    

}

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$controller = new AlumnoController();

// Eliminar parámetros de query
$request = explode('?', $request)[0];
$segments = explode('/', trim($request, '/'));


// Ejemplo: localhost/alumnocontroller.php/id/1
// Ejemplo: localhost/alumnocontroller.php/apellido/juan

///alumnos/5 → ['alumnos', '5']

if ($method === 'GET') {
    if (isset($segments[1]) && isset($segments[2])) {
        if($segments[1] =='id'){
             $controller->obtenerAlumnosId($segments[2]);
        }else if($segments[1] =='apellido'){
            $controller->obtenerAlumnoApellido($segments[2]);
        }
       
    } else {
        $controller->obtenerAlumnos();
    }
} 

?>
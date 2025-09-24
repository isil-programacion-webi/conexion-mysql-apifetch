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



    function obtenerAlumnosId($data){
        $id = $data['idalumnos'] ?? null;
        $alumno = new AlumnoModel();
        $this->deliver_response(200, "Alumno por ID", $alumno->getAlumnosId( $id));
    }


   

}


$controller = new AlumnoController();

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $controller->obtenerAlumnosId($data);
}



?>
<?php
ini_set('display_errors', 0); // Oculta errores en la salida
ini_set('log_errors', 0);     // Registra errores en el log
error_reporting(E_ALL); 

include_once __DIR__ . '/../shared/config/controller.php';
include 'alumnoModel.php'; 

header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);

class AlumnoController extends Controller{
    
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

    function registrarAlumno($data){
        $alumno = new AlumnoModel();
        $this->deliver_response(200, "Registrado", $alumno->insertarAlumnos($data['nombre'], $data['apellido']));
    }

}

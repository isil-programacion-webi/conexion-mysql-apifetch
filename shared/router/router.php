<?php
ini_set('display_errors', 1); // Oculta errores en la salida
ini_set('log_errors', 1);     // Registra errores en el log
error_reporting(E_ALL); 

include_once "../../alumno/alumnoController.php";


header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$controller = new AlumnoController();

$request = explode('?', $request)[0];
$segments = explode('/', trim($request, '/'));

if ($method === 'POST') {
    $controller->registrarAlumno($data);
}else if ($method === 'GET') {
    if (isset($segments[3])) {
        
        $controller->obtenerAlumnosId($segments[4]);
        
    } else {
         $controller->obtenerAlumnos();
    }
}

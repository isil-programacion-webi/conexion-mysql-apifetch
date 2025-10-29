<?php
include 'cursosModelo.php'; 

header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);

class CursosController{


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

    function obtenerCursos(){
        $cursos = new CursosModelo();
        $this->deliver_response(200, "Listado de cursos", $cursos->getCursos());
    }

    function registrarCursos($data){
        $cursos = new CursosModelo();
        $this->deliver_response(200, "Curso registrado", $cursos->insertarCursos(
            $data->curso,
            $data->descripcion,
            $data->horario,
            $data->docente
        ));
    }

    function actualizarCursos($data){
        $cursos = new CursosModelo();
        $this->deliver_response(200, "Curso actualizado", $cursos->actualizarCursos(
            $data->idcurso,
            $data->curso,
            $data->descripcion,
            $data->horario,
            $data->docente
        ));
    }

    function eliminarCursos($idcurso){
        $cursos = new CursosModelo();
        $this->deliver_response(200, "Curso eliminado", $cursos->eliminarCurso($idcurso));
    }
}


$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$controller = new CursosController();

$request = explode('?', $request)[0];
$segments = explode('/', trim($request, '/'));

if ($method === 'GET') {
    
    $controller->obtenerCursos();
    
}
    


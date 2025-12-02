<?php
ini_set('display_errors', 1); // Oculta errores en la salida
ini_set('log_errors', 1);     // Registra errores en el log
error_reporting(E_ALL); 

include_once __DIR__ . '/../shared/config/controller.php';
include 'cursosModelo.php'; 

header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);

class CursosController extends Controller{

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

    


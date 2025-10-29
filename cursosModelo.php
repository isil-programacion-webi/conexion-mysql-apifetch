<?php
include 'cursos.php'; 

class CursosModelo {

    private $db;

    public function __construct() {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname  = 'java_cursos';

        $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }

    public function getCursos() {
        $stmt = $this->db->prepare("SELECT * FROM cursos");
        $stmt->execute();
        
       return $stmt->fetchAll(PDO::FETCH_CLASS, 'Cursos');

    }

    public function insertarCursos( $curso, $descripcion,  $horario, $docente){
        $stmt = $this->db->prepare("INSERT INTO cursos( curso, descripcion, horario, docente) VALUES (:curso,:descripcion,:horario, :docente)");
        
        $stmt->bindParam(':curso', $curso);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':horario', $horario);
        $stmt->bindParam(':docente', $docente);
        
        return $stmt->execute(); 
    }

    public function actualizarCursos($idcurso, $curso, $descripcion,  $horario, $docente){

        $stmt = $this->db->prepare("UPDATE cursos SET curso= :curso,descripcion= :descripcion,horario= :horario,docente= :docente WHERE idcurso= :idcurso");

        $stmt->bindParam(':idcurso', $idcurso);
        $stmt->bindParam(':curso', $curso);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':horario', $horario);
        $stmt->bindParam(':docente', $docente);
        return $stmt->execute(); 
    }


    public function eliminarCurso($idcurso){

        $stmt = $this->db->prepare("DELETE FROM cursos WHERE idcurso= :idcurso");
        $stmt->bindParam(':idcurso', $idcurso);
        return $stmt->execute();
    }
}


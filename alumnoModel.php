<?php
include 'alumnos.php'; 
include 'cursos.php'; 

class AlumnoModel {

    private $db;

    public function __construct() {
        $host = 'localhost';
        $username = 'root';
        $password = '123456789';
        $dbname  = 'matricula';

        $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }

    public function getAlumnos() {
        $stmt = $this->db->prepare("SELECT * FROM alumnos");
        $stmt->execute();
        
       return $stmt->fetchAll(PDO::FETCH_CLASS, 'Alumnos');

    }


    public function getAlumnosId($id) {
        $stmt = $this->db->prepare("SELECT * FROM alumnos WHERE idalumnos=:idalumnos");
        $stmt->bindParam(':idalumnos', $id, PDO::PARAM_INT);
        $stmt->execute();
        
       return $stmt->fetchAll(PDO::FETCH_CLASS, 'Alumnos');

    }

    public function getAlumnosLikeApellido($apellido){
        $stmt = $this->db->prepare('SELECT * FROM alumnos WHERE apellido like :apellido');
        $apellido = "%$apellido%";
        $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Alumnos');
    }
    
    public function getCursos() {

        $stmt = $this->db->prepare("SELECT * FROM cursos");
        $stmt->execute();
        
       return $stmt->fetchAll(PDO::FETCH_CLASS, 'Cursos');

    }


}


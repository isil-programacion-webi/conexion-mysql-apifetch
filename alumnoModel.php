<?php
include 'alumnos.php'; 

class AlumnoModel {

    private $db;

    public function __construct() {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname  = 'java_cursos';

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

    

}


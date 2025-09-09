<?php
include 'alumnos.php'; 

class AlumnoModel {

    private $db;

    public function __construct() {
        $host = 'localhost';
        $username = 'root';
        $password = '123456789';
        $dbname  = 'java_cursos';

        $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }

    public function getAlumnos() {
        $stmt = $this->db->prepare("SELECT * FROM alumnos");
        $stmt->execute();
        
       return $stmt->fetchAll(PDO::FETCH_CLASS, 'Alumnos');

    }

    public function insertAlumno($nombre, $apellido) {
        $stmt = $this->db->prepare("INSERT INTO alumnos (nombre, apellido) VALUES (:nombre, :apellido)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);

        if ($stmt->execute()) {
            return "Alumno registrado con éxito.";
        } else {
            return "Error al registrar alumno.";
        }
    }

}


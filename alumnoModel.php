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

    public function updateAlumno($idalumnos,$nombre, $apellido) {
        $stmt = $this->db->prepare("UPDATE alumnos SET nombre= :nombre, apellido= :apellido WHERE idalumnos= :idalumnos");
        $stmt->bindParam(':idalumnos', $idalumnos);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);

        if ($stmt->execute()) {
            return "Alumno actualizado con éxito.";
        } else {
            return "Error al actualizado alumno.";
        }
    }
    

}


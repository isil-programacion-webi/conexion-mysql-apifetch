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
    
    public function insertarAlumnos($nombre, $apellido){
        $stmt = $this->db->prepare("INSERT INTO alumnos (nombre, apellido) VALUES (:nombre, :apellido)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        return $stmt->execute(); 
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

    
    public function getCursos() {

        $stmt = $this->db->prepare("SELECT * FROM cursos");
        $stmt->execute();
        
       return $stmt->fetchAll(PDO::FETCH_CLASS, 'Cursos');

    }


}


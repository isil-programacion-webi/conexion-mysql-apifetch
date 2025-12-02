<?php
include __DIR__ . '/../shared/config/connection.php';
include 'alumnos.php'; 

class AlumnoModel {

    private $db;

   
    public function __construct() {
       $this->db =  new Connection();
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



}


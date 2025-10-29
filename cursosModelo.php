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


}


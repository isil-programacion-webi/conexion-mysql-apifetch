<?php
class Connection{

    private $db;

    public function __construct() {
        $host = 'sql100.infinityfree.com';
        $username = 'if0_40581069';
        $password = 'qYbj46i8vYPftl';
        $dbname  = 'if0_40581069_academia';

        try {
            // 1. Conectar al servidor MySQL (sin seleccionar base de datos todavía)
            $this->db  = new PDO("mysql:host=$host", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 2. Crear la base de datos si no existe
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname 
                    CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
            $this->db->exec($sql);

            // 3. Conectar ahora a la base de datos recién creada
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 4. Crear tabla estudiantes si no existe
            $sqlEstudiantes = "CREATE TABLE IF NOT EXISTS alumnos (
                idalumnos INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL,
                apellido VARCHAR(100) NOT NULL
            )";

            $this->db->exec($sqlEstudiantes);

            // 5. Crear tabla cursos si no existe
            $sqlCursos = "CREATE TABLE IF NOT EXISTS cursos (
                idcurso INT AUTO_INCREMENT PRIMARY KEY,
                curso VARCHAR(100) UNIQUE NOT NULL,
                horario VARCHAR(100) NOT NULL,
                docente VARCHAR(100) NOT NULL
            )";

            $this->db->exec($sqlCursos);
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function prepare($sql) {
        return $this->db->prepare($sql);
    }

}

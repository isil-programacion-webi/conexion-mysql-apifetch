<?php

include 'alumnoController.php'; 

$alumno = new AlumnoController();

$data = [
    'nombre' => 'roca',
    'apellido' => 'perez'
];

$alumno->registrarAlumno($data);
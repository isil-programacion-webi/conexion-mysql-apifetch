<?php
include 'cursosModelo.php'; 


$cursos = new CursosModelo();

$cursos->eliminarCurso("3");
?>
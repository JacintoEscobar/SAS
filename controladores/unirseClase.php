<?php

include '../modelos/Estudiante.php';

session_start();

$alumno = new Estudiante($_SESSION['i']);

echo json_encode($alumno->unirseClase(htmlentities($_POST['c'])));
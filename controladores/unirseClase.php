<?php

include '../modelos/Estudiante.php';

session_start();

$alumno = new Estudiante($_SESSION['i']);

echo json_encode($alumno->unirseClase(htmlspecialchars($_POST['c'], ENT_QUOTES, 'UTF-8')));

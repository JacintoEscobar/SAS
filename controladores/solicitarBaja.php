<?php

include '../modelos/Estudiante.php';

session_start();

$estudiante = new Estudiante($_SESSION['i']);

echo json_encode($estudiante->solicitarBaja(htmlentities($_POST['idc'])));

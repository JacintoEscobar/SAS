<?php

include '../modelos/Estudiante.php';

session_start();

$estudiante = new Estudiante($_SESSION['i']);

echo json_encode($estudiante->solicitarBaja(htmlspecialchars($_POST['idc'], ENT_QUOTES, 'UTF-8')));

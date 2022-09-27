<?php

include_once '../modelos/Usuario.php';

$tipoCred = htmlentities($_POST['t']);
$credrencial = htmlentities($_POST['c']);
$id = htmlentities($_POST['i']);

$usuario = new Usuario();

echo json_encode($usuario->actualizarCredencial($tipoCred, $credrencial, $id));

<?php

include_once '../modelos/Usuario.php';

$tipoCred = htmlspecialchars($_POST['t'], ENT_QUOTES, 'UTF-8');
$credrencial = htmlspecialchars($_POST['c'], ENT_QUOTES, 'UTF-8');
$id = htmlspecialchars($_POST['i'], ENT_QUOTES, 'UTF-8');

$usuario = new Usuario();

echo json_encode($usuario->actualizarCredencial($tipoCred, $credrencial, $id));

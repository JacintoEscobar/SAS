<?php

include_once '../modelos/Usuario.php';

session_start();
$idUsuario = $_SESSION['i'];

$nuevoUsuario = htmlentities($_POST['u']);

$usuario = new Usuario();
$usuario->setID($idUsuario);

echo json_encode($usuario->cambiarUsuario($nuevoUsuario));

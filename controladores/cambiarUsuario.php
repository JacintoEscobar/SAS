<?php

include_once '../modelos/Usuario.php';

session_start();
$idUsuario = $_SESSION['i'];

$nuevoUsuario = htmlspecialchars($_POST['u'], ENT_QUOTES, 'UTF-8');

$usuario = new Usuario();
$usuario->setID($idUsuario);

echo json_encode($usuario->cambiarUsuario($nuevoUsuario));

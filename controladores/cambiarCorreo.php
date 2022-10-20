<?php

include_once '../modelos/Usuario.php';

session_start();
$idUsuario = $_SESSION['i'];

$nuevoUsuario = htmlspecialchars($_POST['c'], ENT_QUOTES, 'UTF-8');

$usuario = new Usuario();
$usuario->setID($idUsuario);

echo json_encode($usuario->cambiarCorreo($nuevoUsuario));
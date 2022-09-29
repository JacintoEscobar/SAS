<?php

include_once '../modelos/Usuario.php';

session_start();
$idUsuario = $_SESSION['i'];

$nuevoUsuario = htmlentities($_POST['c']);

$usuario = new Usuario();
$usuario->setID($idUsuario);

echo json_encode($usuario->cambiarCorreo($nuevoUsuario));
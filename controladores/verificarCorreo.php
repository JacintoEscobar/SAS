<?php

use function PHPSTORM_META\type;

include_once '../modelos/Usuario.php';

$correo = htmlspecialchars($_POST['c'], ENT_QUOTES, 'UTF-8');

$usuario = new Usuario();

$idUsuario = $usuario->verificarCorreo($correo);

if (gettype($idUsuario) == 'string') {
    echo json_encode(array('error' => $idUsuario));
} else {
    echo json_encode(array('idUsuario' => $idUsuario));
}

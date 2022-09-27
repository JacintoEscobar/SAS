<?php

use function PHPSTORM_META\type;

include_once '../modelos/Usuario.php';

$correo = htmlentities($_POST['c']);

$usuario = new Usuario();

$idUsuario = $usuario->verificarCorreo($correo);

if (gettype($idUsuario) == 'string') {
    echo json_encode(array('error' => $idUsuario));
} else {
    echo json_encode(array('idUsuario' => $idUsuario));
}

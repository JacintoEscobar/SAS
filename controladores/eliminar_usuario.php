<?php

include_once '../modelos/Usuario.php';

$idUsuario = htmlentities($_POST['idUsuario']);

$usuario = new Usuario(null, null);
$usuario->setID($idUsuario);

try {
    if ($usuario->eliminarUsuario()) {
        echo json_encode(['RESPUESTA' => 'Usuario eliminado de manera satisfactoria.']);
    } else {
        echo json_encode(['RESPUESTA' => 'No se pudo hacer la eliminación del usuario.']);
    }
} catch (Exception $ex) {
    throw $ex;
}

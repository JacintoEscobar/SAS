<?php

include_once '../modelos/Usuario.php';

$idUsuario = htmlspecialchars($_POST['idUsuario'], ENT_QUOTES, 'UTF-8');

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

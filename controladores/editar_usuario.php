<?php

include '../modelos/Usuario.php';

$usuario = new Usuario(htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8'), md5(htmlspecialchars($_POST['contraseña'], ENT_QUOTES, 'UTF-8')));

try {
    if ($usuario->actualizar($_POST)) {
        echo json_encode(['RESPUESTA' => 'Usuario actualizado con éxito']);
    } else {
        throw new Exception('Ocurrió un error al actualizar la información del usuario.');
    }
} catch (Exception $ex) {
    throw $ex;
}

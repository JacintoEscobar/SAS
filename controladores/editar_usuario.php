<?php

include '../modelos/Usuario.php';

$usuario = new Usuario(htmlentities($_POST['usuario']), md5(htmlentities($_POST['contraseña'])));

try {
    if ($usuario->actualizar($_POST)) {
        echo json_encode(['RESPUESTA' => 'Usuario actualizado con éxito']);
    } else {
        throw new Exception('Ocurrió un error al actualizar la información del usuario.');
    }
} catch (Exception $ex) {
    throw $ex;
}

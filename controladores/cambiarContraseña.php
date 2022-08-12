<?php

include '../modelos/Usuario.php';

session_start();

if (isset($_POST)) {
    if (isset($_POST['ca']) && isset($_POST['cn'])) {
        $contraseñaActual = htmlentities($_POST['ca']);
        $nuevaContraseña = htmlentities($_POST['cn']);

        $usuario = new Usuario($_SESSION['u'], $contraseñaActual);

        $respuesta = $usuario->cambiarContraseña($nuevaContraseña);

        if ($respuesta == 'CONTRASEÑA_ACTUALIZADA') {
            echo json_encode(array('t' => $_SESSION['t']));
        } else {
            echo json_encode($respuesta);
        }
    } else {
        echo json_encode(array('ERROR_POST_DATOS' => 'Ocurrió un error con la información del formulario.'));
    }
} else {
    echo json_encode(array('ERROR_POST' => 'Ocurrió un error con el envío del formulario.'));
}

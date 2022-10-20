<?php

include_once '../modelos/Usuario.php';

if (isset($_POST)) {
    $username = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $contraseña = htmlspecialchars($_POST['contraseña'], ENT_QUOTES, 'UTF-8');

    $usuario = new Usuario($username, $contraseña);
    $usuarioRegistrado = $usuario->verificarUsuario();

    if (is_null($usuarioRegistrado)) {
        echo json_encode(['CREDENCIALES_INCORRECTAS' => 'Credenciales incorrectas.']);
    } elseif (isset($usuarioRegistrado['ERROR_DE_CONEXION'])) {
        echo json_encode($usuarioRegistrado);
    } else {
        session_start();
        $_SESSION['i'] = $usuarioRegistrado['id'];
        $_SESSION['u'] = $usuarioRegistrado['usuario'];
        $_SESSION['t'] = $usuarioRegistrado['tipo'];

        echo json_encode(array('tipo' => $_SESSION['t']));
    }
}

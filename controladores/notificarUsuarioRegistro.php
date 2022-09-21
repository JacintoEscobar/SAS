<?php

include '../modelos/Notificacion.php';

/**
 * Obtenemos los datos del estudiante para notificarle de su alta en el sistema
 */
$nombre = htmlentities($_POST['n']);
$paterno = htmlentities($_POST['p']);
$correo = htmlentities($_POST['co']);
$usuario = htmlentities($_POST['u']);
$contraseña = htmlentities($_POST['con']);

/**
 * Creamos una notificación para enviar el correo al nuevo usuario
 */
$notificacion = new Notificacion('Notificación de registro en SAS.');

/**
 * Enviamos la notificación
 */
echo json_encode($notificacion->usuarioRegistrado($correo, $nombre, $paterno, $usuario, $contraseña));

